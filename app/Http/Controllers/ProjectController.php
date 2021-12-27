<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

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
            'endDate' => 'required|after:today',
            'startDate' => 'required|after_or_equal:today',
        ]);

        $project = new Project;
        $project->title = $request->input('projectTitle');
        $project->save();

        $project->folder = 'projectFiles/PR-' . $project->id;
        $project->sysRequirements = $request->file('projectSR')->storeAs($project->folder, $request->projectSR->getClientOriginalName());

        $project->startDate = Carbon::parse($request->startDate)->format('Y-m-d');
        $project->endDate = Carbon::parse($request->endDate)->format('Y-m-d');
        $project->save();

        $project->users()->attach($request->user()->id);
        return response()->json(['success'=>'Data is successfully added'], 200);
        // return redirect()->action([ProjectController::class, 'show']);
    }

    public function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 

    public function detailView(Project $project) {
        $tasks = $project->tasks;
        if(auth()->user()->roleID == 3 || auth()->user()->roleID == 7){
            $users = User::where('roleID', 7)->get();
            $head = 3;
        }
        if(auth()->user()->roleID == 4 || auth()->user()->roleID == 8){
            $users = User::where('roleID', 8)->get();
            $head = 4;
        }
        if(auth()->user()->roleID == 5 || auth()->user()->roleID == 9){
            $users = User::where('roleID', 9)->get();
            $head = 5;
        }
        if(auth()->user()->roleID == 6 || auth()->user()->roleID == 10){
            $users = User::where('roleID', 10)->get();
            $head = 6;
        }

        $PROJECT_FOLDER = $project->folder;
        $files = Storage::disk('local')->listContents($PROJECT_FOLDER);
        foreach ($files as &$file) {
            $file['size'] = $this->formatBytes($file['size']);
        };
        unset($file);
        $files = collect($files);

        return view('project.detail', compact('project', 'files', 'tasks', 'users', 'head'));
    }

    public function taskView(Project $project, Task $task) {

        $task = Task::where('id', $task->id)->first();
        

        return view('project.task.detail', compact('task'));
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
        $task->description = $request->input('description');
        $task->save();

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id]);
    }

    public function addMember(Request $request, Project $project){
        
        $users = $request->input('users');
        $project->users()->attach($users);
        return redirect('projects/detail/'.$project->id);
    }
}
