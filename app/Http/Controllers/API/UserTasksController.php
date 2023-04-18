<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserTasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TasksResource;

class UserTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = UserTasks::all();
        return response([ 'tasks' => TasksResource::collection($tasks), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'tasks_id' => 'required',
            'start_time' => 'required'
            'end_time' => 'required'
            'remarks' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $task = UserTasks::create($data);

        return response(['task' => new TasksResource($task), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTasks  $task
     * @return \Illuminate\Http\Response
     */
    public function show(UserTasks $task)
    {
        return response(['task' => new TasksResource($task), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTasks  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTasks $task)
    {
        $task->update($request->all());

        return response(['task' => new TasksResource($task), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTasks  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTasks $task)
    {
        $task->delete();

        return response(['message' => 'Deleted']);
    }
}