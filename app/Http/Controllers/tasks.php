<?php

namespace App\Http\Controllers;

use App\Models\assignment;
use App\Models\EmployeeReports;
use App\Models\User;
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

    public function getAllEmployees()
    {
        $employees=User::where('is_admin',0)->get();
        return json_encode($employees);
    }

    public function saveAssignment(Request $request)
    {
        $assignments=$request->assignments;
//
        foreach ($assignments as $item) {
            $assignment =new assignment;
            $assignment->employeeId=$item['employeeId'];
            $assignment->taskId=$item['taskId'];
            $assignment->projectId=$item['projectId'];
            $assignment->save();
            }
        return response('Task assigned successfully',200);
    }
    public function deleteTask($id)
    {
        $project=\App\Models\tasks::find($id);
        $project->delete();
        return redirect("/Assign_task/$id");
    }
    public function updateTaskIndex($id)
    {
        $Task=\App\Models\tasks::find($id);
        return view('User.TaskUpdate')->with(compact('Task'));
    }

    public function updateTask($id,Request $request)
    {
        $Task=\App\Models\tasks::find($id);
        $Task->name=$request['name'];
        $Task->deadline=$request['deadline'];
        $Task->description=$request['description'];
        $Task->status=$request['status'];
        $Task->save();
        return response('Task updated successfully',200);
    }

    public function getTasksAssignedEmployees($id)
    {
        $employees=\App\Models\User::whereIn('id',$query=assignment::where('taskId',$id)->select('employeeId')->get())->where('is_admin',0)->get();
        return json_encode($employees);
    }
    public function getMyTasks()
    {
        $tasks=\App\Models\tasks::whereIn('id',assignment::where('employeeId',auth()->id())->select('taskId')->get())->get();
        return json_encode($tasks);
    }

    public function submitTask(Request $request)
    {
        $check=\App\Models\assignment::where('employeeId',auth()->id())->where('taskId',$request['taskId'])->first();

       if($check=="") {
           $report = new EmployeeReports;
           $taskID = assignment::where('taskId', $request['taskId'])->select('taskId')->first();
           $report->assignmentId = $taskID['taskId'];
           $report->report = $request['report'];
           $report->save();

           $task = \App\Models\tasks::where('id', $request['taskId'])->first();
           $task->status = "Submited";
           $task->save();
           return response('Task submitted Successfully.', 200);
       }
       else
           return response("You can't re-submit a task.");
    }

}
