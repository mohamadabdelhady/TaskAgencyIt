<?php

namespace App\Http\Controllers;

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
        $employees=User::where('is_admin',0)->get();
        return view('User.update')->with(compact('project','employees'));
    }
}
