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

use function PHPUnit\Framework\isEmpty;

class ProjectController extends Controller
{
    //
    public function index(Request $request)
    {
        $projectsDept1 = Project::where('deptID', '3')->get();
        $projectsDept2 = Project::where('deptID', '4')->get();
        $projectsDept3 = Project::where('deptID', '5')->get();
        $projectsDept4 = Project::where('deptID', '6')->get();
        return view('project.projects', compact('projectsDept1', 'projectsDept2', 'projectsDept3', 'projectsDept4'));
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
        $project->deptID = auth()->user()->roleID;
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

    public function detailView(Project $project, $user_tabs) {
        $tasks = $project->tasks;
        if(auth()->user()->roleID == 3 ||  $project->deptID == 3){
            $users_department = User::where('roleID', 7)->get();
            $head = 3;
            $task_members = ProjectUser::where('project_id', $project->id)->orderBy('user_id')->get();
        }
        else if(auth()->user()->roleID == 4 || $project->deptID == 4){
            $users_department = User::where('roleID', 8)->get();
            $head = 4;
            $task_members = ProjectUser::where('project_id', $project->id)->orderBy('user_id')->get();
        }
        else if(auth()->user()->roleID == 5 || $project->deptID == 5){
            $users_department = User::where('roleID', 9)->get();
            $head = 5;
            $task_members = ProjectUser::where('project_id', $project->id)->orderBy('user_id')->get();
        }
        else if(auth()->user()->roleID == 6 || $project->deptID == 6){
            $users_department = User::where('roleID', 10)->get();
            $head = 6;
            $task_members = ProjectUser::where('project_id', $project->id)->orderBy('user_id')->get();
        }
        $users = User::all();
        $PROJECT_FOLDER = $project->folder;
        $files = Storage::disk('local')->listContents($PROJECT_FOLDER);
        foreach ($files as &$file) {
            $file['size'] = $this->formatBytes($file['size']);
        };
        unset($file);
        $files = collect($files);
        $project_members = ProjectUser::where('project_id', $project->id)->get();


        return view('project.detail', compact('project', 'files', 'tasks', 'users', 'head', 'user_tabs', 'task_members', 'users_department', 'project_members'));
    }

    public function taskView(Project $project, Task $task) {

        $task = Task::where('id', $task->id)->first();


        return view('project.task.detail', compact('task'));
    }

    public function taskRemove(Project $project, Task $task)
    {
        $task = Task::where('id', $task->id)->first();
        $task->delete();
        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks']);
    }

    public function taskChangeStatus(Project $project, Task $task)
    {
        $task = Task::where('id', $task->id)->first();
        if($task->status == 'Ongoing'){
            $task->status = 'Completed';
        }
        else{
            $task->status = 'Ongoing';
        }
        $task->save();
        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks']);
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
        $task->status = 'Ongoing';
        $task->save();

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id]);
    }

    public function addMember(Request $request, Project $project){

        // dd($request->users);

        $users = $request->input('users');

        $project_users = ProjectUser::where('project_id', $project->id)->get();

        // dd($project_users);
        $flag = 0;
        foreach($project_users as $project_user){
            $project_user->delete();
        }



        if($users==null){

        }
        else{
            foreach($users as $user){
                $project_users = new ProjectUser();
                $project_users->project_id = $project->id;
                $project_users->user_id = $user;
                $project_users->save();
            }

        }

        return redirect('projects/detail/'.$project->id. '/tasks')->with('addMember', 'Assign Member Successfuly');

    }

    public function searchProject(Request $request){
        $search = $request->search;
        if(auth()->user()->roleID == 3 || auth()->user()->roleID == 7){
            $deptID = 3;
        }
        if(auth()->user()->roleID == 4 || auth()->user()->roleID == 8){
            $deptID = 4;
        }
        if(auth()->user()->roleID == 5 || auth()->user()->roleID == 9){
            $deptID = 5;
        }
        if(auth()->user()->roleID == 6 || auth()->user()->roleID == 10){
            $deptID = 6;
        }

        $searches = Project::where('title', 'like', '%'.$search.'%')->where('deptID', $deptID)->paginate(5);
        $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
        return view('project.searchProject', compact('searches', 'search', 'id'));
    }
}
