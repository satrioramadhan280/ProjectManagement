<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
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

    public function addProject(Request $request)
    {
        $request->validate([
            'projectTitle' => 'required|min:3|max:50',
            'projectSR' => 'required|mimes:pdf',
            'endDate' => 'required|after:today'
        ]);

        $project = new Project;
        $project->title = $request->input('projectTitle');

        $project->folder = 'projectFiles/PR-' . $project->id;
        $project->sysRequirements = $request->file('projectSR')->storeAs($project->folder, $request->projectSR->getClientOriginalName());

        $project->startDate = Carbon::parse($request->startDate)->format('Y-m-d');
        $project->endDate = Carbon::parse($request->endDate)->format('Y-m-d');
        $project->save();

        $project->users()->attach($request->user()->id);
        return redirect()->action([ProjectController::class, 'show']);
    }

    public function detailView(Project $project) {
        $tasks = $project->tasks;
        if(auth()->user()->roleID == 3){
            $users = User::where('roleID', 7)->get();
        }
        if(auth()->user()->roleID == 4){
            $users = User::where('roleID', 8)->get();
        }
        if(auth()->user()->roleID == 5){
            $users = User::where('roleID', 9)->get();
        }
        if(auth()->user()->roleID == 6){
            $users = User::where('roleID', 10)->get();
        }
        return view('project.detail', compact('project', 'tasks', 'users'));
    }

    public function addTaskView(Project $project)
    {
        return view('project.task.add', compact('project'));   
    }

    public function addTask(Request $request, Project $project)
    {
        $request->validate([
            'taskName' => 'required|min:3',
        ]);
        $task = new Task;
        $task->name = $request->input('taskName');
        $task->project()->associate($project);
        $task->save();

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id]);
    }

    public function addMember(Request $request, Project $project){
        $projectUser = new ProjectUser;

        $projectUser->project_id = $project->id;
        $projectUser->user_id = $request->user_id;

        $projectUser->save();

        return redirect('projects/detail/'.$projectUser->id);
    }
}
