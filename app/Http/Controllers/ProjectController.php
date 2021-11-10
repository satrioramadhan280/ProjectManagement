<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function show(Request $request)
    {
        $projects = $request->user()->projects->toQuery()->paginate(5);

        return view('project.projects', compact('projects'));
    }

    public function add()
    {
        return view('project.add');
    }

    public function add_project(Request $request)
    {
        $project = new Project;
        $project->projectTitle = $request->input('projectTitle');
        $project->save();

        $project->users()->attach($request->user()->id);
        return redirect()->action([ProjectController::class, 'show']);
    }
}
