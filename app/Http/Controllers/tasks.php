<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tasks extends Controller
{
    public function createTaskIndex($id)
    {
        $projectName=\App\Models\projects::find($id)->select('name')->first();
        return view('User.newTask')->with(compact('projectName','id'));
    }
    public function createTask(Request $request)
    {
        $task= new \App\Models\tasks;
        $task->name=$request->name;
        $task->description=$request->description;
        $task->deadline=$request->deadline;
        $task->projectId=$request->ProjectId;
        $task->save();

        return response('Task created successfully',200);
    }

    public function assignTaskIndex($id)
    {
        $projectName=\App\Models\projects::find($id)->select('name')->first();
        return view('User.newAssign')->with(compact('projectName','id'));
    }

    public function loadAllTasks()
    {
        $tasks=\App\Models\tasks::all();
        return json_encode($tasks);
    }
}
