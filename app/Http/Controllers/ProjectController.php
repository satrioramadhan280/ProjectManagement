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
            'projectTitle' => 'required|min:3|max:50',
            'projectSR' => 'required|mimes:pdf',
        ]);

        $project = new Project;
        $project->title = $request->input('projectTitle');
        $project->save();

        $project->folder = 'projectFiles/PR-' . $project->id;
        $project->sysRequirements = $request->file('projectSR')->storeAs($project->folder, $request->sysRequirements->getClientOriginalName());
        $project->save();

        $project->users()->attach($request->user()->id);
        return redirect()->action([ProjectController::class, 'show']);
    }
}
