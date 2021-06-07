<?php

namespace App\Http\Controllers;

use App\Http\Middleware\NNToken;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->user = (new NNToken)->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $taks = TaskModel::where(['id_user' => $this->user['id']])->get();

            $data = [
                'message' => $taks ? 'Task encontrada.' : 'Tasks não encontrada.',
                'data' => new TaskCollection($taks)
            ];
            $status = 200;
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        try {
            $input = $request->all();

            $model = new TaskModel;
            $model->description = $input['description'];
            $model->enable      = 1;
            $model->id_user     = $this->user['id'];
            $model->save();

            $data = [
                'message' => 'taks criado.',
                'data'    => new TaskResource($model),
            ];
            $status = 201;
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $taks = TaskModel::where(['id_user' => $this->user['id'], 'id' => $id])->first();

            $data = [
                'message' => $taks ? 'Task encontrada.' : 'Tasks não encontrada.',
                'data' => new TaskResource($taks)
            ];
            $status = 200;
        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        try {
            $taskFind = TaskModel::where(['id_user' => $this->user['id'], 'id' => $id]);

            if ($taskFind->count()) {
                $input = $request->all();
                $model = $taskFind->first();
    
                $model->description = $input['description'];
                $model->enable      = $input['enable'];
                $model->save();
    
                $data = [
                    'message' => 'Task atualizada.',
                    'data'    => new TaskResource($model),
                ];
                $status = 201;
            } else {
                $data = [
                    'message' => 'Task não encontrada.',
                    // 'data' => ''
                ];
                $status = 400;
            };

        } catch (\Throwable $th) {
            $data = [
                'message' => 'Um erro ocorreu, tente novamente mais tarde.',
                // 'data' => ''
            ];
            $status = 400;
        }

        return response($data, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $taskFind = TaskModel::where(['id_user' => $this->user['id'], 'id' => $id]);

            if ($taskFind->count()) {
                $taskFind->delete();
    
                $data = [
                    'message' => 'taks deletada.',
                    'data'    => '',
                ];
                $status = 201;
            } else {
                $data = [
                    'message' => 'Task não encontrada.',
                    // 'data' => ''
                ];
                $status = 400;
            };

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
