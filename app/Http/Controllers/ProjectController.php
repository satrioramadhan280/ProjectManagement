<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProjectController extends Controller
{
    //

    public function show(Request $request)
    {
        $projects = $request->user()->projects;
        if (!$projects->isEmpty()) {
            $projects = $projects->toQuery()->paginate(5);
        }

        return view('project.projects', compact('projects'));
    }

    public function add()
    {
        return view('project.add');
    }

    public function add_project(Request $request)
    {
        $request->validate([
            'projectTitle' => 'required',
            'projectSR' => 'required|mimes:pdf',
        ]);

        $project = new Project;
        $project->projectTitle = $request->input('projectTitle');
        $project->save();

        $project->projectFolder = 'projectFile/PR-' . $project->id;
        $project->projectSR = $request->file('projectSR')->storeAs($project->projectFolder, $request->projectSR->getClientOriginalName());
        $project->save();

        $project->users()->attach($request->user()->id);
        return redirect()->action([ProjectController::class, 'show']);
    }
}
