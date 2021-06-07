<?php

namespace App\Http\Controllers;

use App\Http\Middleware\NNToken;
use App\Http\Resources\UserResource;
use App\Models\TaskModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request, NNToken $NNtoken)
    {
        try {
            $input = $request->all();

            $emailExist = UserModel::where(['email' => $input['email']])->count();

            if ($emailExist) {
                $data = [
                    'message' => 'Email já cadastrado.',
                    // 'data' => ''
                ];
                $status = 400;
            } else {
                $model = new UserModel;
                $model->name     = $input['name'];
                $model->email    = $input['email'];
                $model->password = base64_encode($input['password']);
                $model->save();

                $data = [
                    'message' => 'usuário criado.',
                    'token'   => $NNtoken->make($model),
                    'data'    => new UserResource($model),
                ];
                $status = 201;
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    public function update(Request $request, NNToken $NNtoken)
    {
        try {
            $this->user = $NNtoken->user();

            $input = $request->all();

            $userFind = UserModel::where(['id' => $this->user['id']]);

            if ($userFind->count()) {

                $model = $userFind->first();
                $model->name     = $input['name'];
                // $model->email    = $input['email'];
                if (isset($input['password'])) $model->password = base64_encode($input['password']);
                $model->save();

                $data = [
                    'message' => 'usuário atualizado.',
                    'data'    => new UserResource($model),
                ];
                $status = 201;
            } else {
                $data = [
                    'message' => 'usuário não encontrado.',
                    // 'data' => ''
                ];
                $status = 400;
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    public function destroy($id)
    {
            $userFind = UserModel::where(['id' => $id]);

            if ($userFind->count()) {
                
                TaskModel::where(['id_user' => $id])->delete();

                $model = $userFind->first();
                $model->delete();

                $data = [
                    'message' => 'usuário e tasks excluidos.',
                    'data'    => '',
                ];
                $status = 201;
            } else {
                $data = [
                    'message' => 'usuário não encontrado.',
                    // 'data' => ''
                ];
                $status = 400;
            }

        try {
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    public function login(Request $request, NNToken $NNtoken)
    {
            $input = $request->all();
            $user = null;

            if (key_exists('password', $input)) {
                $user = UserModel::where([
                    'email' => $input['email'],
                    'password' => base64_encode($input['password']),
                ])->first();
            } else if (key_exists('auth', $input)) {
                $user = UserModel::where([
                    'email' => $input['email'],
                ])->first();
            }

            if ($user) {
                $data = [
                    'message' => 'usuário encontrado.',
                    'token'   => (new $NNtoken)->make($user),
                    'data' => new UserResource($user),
                ];
            } else {
                $data = [
                    'message' => 'usuário não encontrado.',
                    'data' => []
                ];
            }
            $status = 200;
        try {
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }
}
