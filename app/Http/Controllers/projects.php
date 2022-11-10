<?php

namespace App\Http\Controllers;

use App\Models\assignment;
use App\Models\User;
use Illuminate\Http\Request;

class projects extends Controller
{
    public function loadAllProjects()
    {
        return json_encode($projects=\App\Models\projects::all());
    }

    public function newProjectIndex()
    {
        return view('User.CreateProject');
    }

    public function createNewProject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required',
            'description' => 'required',
        ]);

        $project=new \App\Models\projects();
        $project->name=$request->name;
        $project->deadline=$request->deadline;
        $project->description=$request->description;
        $project->createdBy=auth()->user()->name;
        $project->save();
        return redirect('/');
    }
    public function deleteProject($id)
    {
        $project=\App\Models\projects::find($id);
        $project->delete();
        return redirect('/');
    }

    public function updateProjectIndex($id)
    {
        $project=\App\Models\projects::find($id);
        return view('User.update')->with(compact('project'));
    }

    public function updateProject($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $project=\App\Models\projects::find($id);
        $project->name=$request['name'];
        $project->deadline=$request['deadline'];
        $project->description=$request['description'];
        $project->status=$request['status'];
        $project->save();
        return response('Project updated successfully',200);
    }

    public function getProjectAssignedEmployees($id)
    {
        $employees=\App\Models\User::whereIn('id',$query=assignment::where('projectId',$id)->select('employeeId')->get())->where('is_admin',0)->get();
      return json_encode($employees);
    }
    public function getMyProjects()
    {
        $projects=\App\Models\projects::whereIn('id',assignment::where('employeeId',auth()->id())->select('projectId')->get())->get();
        return json_encode($projects);
    }
}
