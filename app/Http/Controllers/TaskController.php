<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. No es retorna: paginacion
        return Task::all();

        $task = Task::all();

        return Response::json([
            'data' => $task->toArray()
        ],200);
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
    public function store(Request $request)
    {
        $task = new Task();

        $this->saveTask($request, $task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //return $tag = Task::findOrFail($id);

        $task = Task::find($id);

        if (!$task) {
            return Response::json([
                'error' => [
                    'message' => 'Task does not exist',
                    'code' => 195
                 ]
            ], 404);
        }

        return Response::json([
            'data' => $task->toArray()
        ],200);
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
    public function update(Request $request, $id)
    {
        //$task = Task::findOrFail($id);

        $task = Task::find($id);

        if (!$task) {
            return Response::json([
                'error' => [
                    'message' => 'Task does not exist',
                    'code' => 195
                ]
            ], 404);
        }

        return Response::json([
            'data' => $task->toArray()
        ],200);

        $this->saveTask($request, $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
    }

    /**
     * @param Request $request
     * @param $tag
     */
    public function saveTask(Request $request, $task)
    {
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->done = $request->done;
        $task->save();
    }
}
