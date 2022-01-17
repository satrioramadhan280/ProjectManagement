<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Filesystem;

use function PHPUnit\Framework\isEmpty;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $projectsDiv = Project::paginate(10);
        $projectsDept1 = Project::where('deptID', '3')->paginate(10);
        $projectsDept2 = Project::where('deptID', '4')->paginate(10);
        $projectsDept3 = Project::where('deptID', '5')->paginate(10);
        $projectsDept4 = Project::where('deptID', '6')->paginate(10);
        $statuses = Status::all();

        $id = ($projectsDiv->currentpage() - 1) * $projectsDiv->perpage() + 1;
        $id1 = ($projectsDept1->currentpage() - 1) * $projectsDept1->perpage() + 1;
        $id2 = ($projectsDept2->currentpage() - 1) * $projectsDept2->perpage() + 1;
        $id3 = ($projectsDept3->currentpage() - 1) * $projectsDept3->perpage() + 1;
        $id4 = ($projectsDept4->currentpage() - 1) * $projectsDept4->perpage() + 1;
        
        return view('project.projects', compact('projectsDiv', 'projectsDept1', 'projectsDept2', 'projectsDept3', 'projectsDept4', 'statuses', 'id', 'id1', 'id2', 'id3', 'id4'));
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
        $statuses = Status::where('id', '!=', $project->status->id)->get();

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
        $task_user = TaskUser::where('project_id', $project->id)->get();

        return view('project.detail', compact('project', 'statuses', 'files', 'tasks', 'users', 'head', 'user_tabs', 'task_members', 'users_department', 'project_members', 'task_user'));
    }

    public function taskView(Project $project, Task $task) {

        $task = Task::where('id', $task->id)->first();


        return view('project.task.detail', compact('task'));
    }

    public function taskRemove(Project $project, Task $task)
    {
        $task = Task::where('id', $task->id)->first();
        $task->delete();

         // Pada saat delete, auto increment terjadi
         DB::statement("ALTER TABLE tasks AUTO_INCREMENT =  1");


         $updateTasks = Task::all();
         // Misalnya salah satu record di delete, id task akan tidak teratur
         // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
         $index = 1;
         foreach ($updateTasks as $key => $f) {
             $f->id = $index;
             $index++;
             $f->save();
         }

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
        $users = $request->input('users');
        // dd($users);

        $request->validate([
            'taskName' => 'required|min:3',
            'taskDescription' => 'required|min:10',
            'users' => 'required'
        ]);



        $task = new Task;
        $task->name = $request->input('taskName');
        $task->project()->associate($project);
        $task->description = $request->input('taskDescription');
        $task->status = 'Ongoing';
        $task->save();

        foreach($users as $user){
            $task_user = new TaskUser();
            $task_user->task_id = $task->id;
            $task_user->project_id = $project->id;
            $task_user->user_id = $user;
            $task_user->save();
        }

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks']);
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

        // Pada saat delete, auto increment terjadi
        DB::statement("ALTER TABLE project_user AUTO_INCREMENT =  1");


        $updateProjectUser = ProjectUser::all();
        // Misalnya salah satu record di delete, id task akan tidak teratur
        // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
        $index = 1;
        foreach ($updateProjectUser as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        return redirect('projects/detail/'.$project->id. '/tasks')->with('addMember', 'Update Member Successfuly');

    }

    public function searchProject(Request $request){
        $search = $request->search;

        if($search == null){
            return redirect('projects/index');
        }
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
        if(auth()->user()->roleID == 2){
            $searches = Project::where('title', 'like', '%'.$search.'%')->paginate(10);
            $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
            return view('project.searchProject', compact('searches', 'search', 'id'));
        }
        $searches = Project::where('title', 'like', '%'.$search.'%')->where('deptID', $deptID)->paginate(10);
        $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
        return view('project.searchProject', compact('searches', 'search', 'id'));
    }

    public function changeStatus(Project $project, Status $status){

        $project->status()->associate($status);
        $project->save();

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks']);
    }

    public function projectStatus(Status $status){
        $projectsDiv = Project::where('status_id', $status->id)->paginate(10);
        $projectsDept1 = Project::where('deptID', '3')->where('status_id', $status->id)->paginate(10);
        $projectsDept2 = Project::where('deptID', '4')->where('status_id', $status->id)->paginate(10);
        $projectsDept3 = Project::where('deptID', '5')->where('status_id', $status->id)->paginate(10);
        $projectsDept4 = Project::where('deptID', '6')->where('status_id', $status->id)->paginate(10);
        $statuses = Status::all();

        $id = ($projectsDiv->currentpage() - 1) * $projectsDiv->perpage() + 1;
        $id1 = ($projectsDept1->currentpage() - 1) * $projectsDept1->perpage() + 1;
        $id2 = ($projectsDept2->currentpage() - 1) * $projectsDept2->perpage() + 1;
        $id3 = ($projectsDept3->currentpage() - 1) * $projectsDept3->perpage() + 1;
        $id4 = ($projectsDept4->currentpage() - 1) * $projectsDept4->perpage() + 1;
        
        return view('project.statusProject', compact('projectsDiv', 'projectsDept1', 'projectsDept2', 'projectsDept3', 'projectsDept4', 'statuses', 'status', 'id', 'id1', 'id2', 'id3', 'id4'));
    }

    public function deleteProject(Project $project){
        ProjectUser::where('project_id', $project->id)->delete();
        Project::destroy($project->id);

        return redirect('projects/index')->with('delete', 'Project sucessfull deleted');
    }
}
