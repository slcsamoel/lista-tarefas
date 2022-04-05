<?php

namespace App\Http\Controllers;

use App\Task;
use Egulias\EmailValidator\Warning\TLD;
use Exception;
use Illuminate\Http\Request;
use Redirect,Response;

class TaskController extends Controller
{




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $taskID = $request->task_id;

            $task = Task::updateOrCreate(['id' => $taskID],
                        ['descricao' => $request->descricao, 'user_id' => $request->user_id]);

            $task->data_criacao = date('d/m/Y', strtotime($task->created_at));
            $task->usuario = $task->user->name;

            return response()->json($task);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $where = array('id' => $id);
        $Task  = Task::where($where)->first();

        return response()->json($Task);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $where = array('id' => $id);
        $Task  = Task::where($where)->first();

        return response()->json($Task);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

            $task = Task::where('id',$id)->delete();
            $resposta = [
                'status'=> 'success',
                'data'  => $task
            ];

            return response()->json($resposta);

           } catch (Exception $e) {

            $resposta = [
                'status'=> 'error',
                'erro'  => $e
            ];

            return response()->json($resposta);
        }

    }
}
