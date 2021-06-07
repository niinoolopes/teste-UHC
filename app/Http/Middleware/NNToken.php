<?php

namespace App\Http\Middleware;

use Closure;

class NNToken
{
    private $headers;
    private $Authorization;
    private $token_data;
    private $token_payload;
    private $response_obrigatorio = ['message' => 'o uso de Token é obrigatório'];
    private $response_login = ['message' => 'Login expirou'];
    private $response_invalid = ['message' => 'Token invalido'];

    public function handle($request, Closure $next)
    {
        $this->init();

        return $next($request);
    }

    private function init()
    {
        $this->headers = getallheaders();

        // if exist token
        if (!isset($this->headers['Authorization']))
            die(json_encode($this->response_obrigatorio));


        $this->Authorization = $this->headers['Authorization'];
        $this->token_data = explode('.', $this->Authorization);


        // o token deve conter 3 partes
        if (count($this->token_data) == 1)
            die(json_encode($this->response_invalid));


        // decode token
        $this->token_payload = $this->token_decode();

        // validate
        if ($this->token_payload['validate'] == false)
            return response()->json($this->response_login);
    }

    public function make($user = false)
    {

        $key = '2020';

        //Header Token
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        //Payload - Content
        $payload = [
            'exp' => date('Y-m-d H:i:s', strtotime("+100 min")),
            'uid' => 1,
            's' => 'nn',
        ];

        if ($user) {
            $user = (object)$user;
            $payload['id'] = $user->id;
            $payload['email'] = $user->email;
        }

        //JSON
        $header = json_encode($header);
        $payload = json_encode($payload);

        //Base 64
        $header = base64_encode($header);
        $payload = base64_encode($payload);

        //Sign
        $sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
        $sign = base64_encode($sign);

        //Token
        $token = $header . '.' . $payload . '.' . $sign;

        return $token;
    }

    private function token_decode()
    {
        $header  = $this->token_data[0];
        $payload = $this->token_data[1];
        $sign    = $this->token_data[2];

        $header  = base64_decode($header);
        $payload = base64_decode($payload);

        $header  = json_decode($header);
        $payload = (array)json_decode($payload);

        $exp = isset($payload['exp']) ? $payload['exp'] : 0;
        $s   = isset($payload['s'])   ? $payload['s']   : '';

        $time = strtotime(date('Y-m-d H:i:s'));
        $exp  = strtotime($exp);

        return [
            'header' => $header,
            'payload' => $payload,
            'sign' => $sign,
            'time' => $time,
            'exp' => $exp,
            'validate' => (($time > $exp) && ($s == 'nn')) ? false : true,
        ];
    }

    public function user()
    {
        $this->init();

        $payload = $this->token_decode();

        return [
            'id' => $payload['payload']['id'],
            'email' => $payload['payload']['email']
        ];
    }

    public function id()
    {
        $this->init();

        $payload = $this->token_decode();

        return $payload['payload']['id'];
    }
}
