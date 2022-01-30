<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Filesystem;
use phpDocumentor\Reflection\Types\Null_;

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
        $today = Carbon::now()->format('Y-m-d');
        $tmrw = Carbon::tomorrow()->format('Y-m-d');

        return view('project.add', compact('today', 'tmrw'));
    }

    public function addProject(Request $request)
    {

        // dd($request);
        // dd($request->user()->id);
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

        $project->startDate = Carbon::parse($request->startDate);
        $project->endDate = Carbon::parse($request->endDate);
        $project->save();


        $notification = new Notification();
        $notification->  notification_type_id = 5;
        $notification->user_id = $request->user()->id;
        $notification->project_id = $project->id;
        $notification->status = 0;
        $notification->save();


        // $project->users()->attach($request->user()->id);
        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks'])->with('create', 'Create Project Sucessful');
        // return redirect()->action([ProjectController::class, 'show']);
    }

    public function editProjectView(Project $project){
        $startDate = Carbon::parse($project->startDate)->format('Y-m-d');
        $endDate = Carbon::parse($project->endDate)->format('Y-m-d');

        return view('project.edit', compact('project', 'startDate', 'endDate'));
    }

    public function editProject(Request $request, Project $project){
        $request->validate([
            'projectTitle' => 'required|min:3|max:50',
            'startDate' => 'required|after_or_equal:today',
            'endDate' => 'required|after_or_equal:today',
        ]);

        $project->title = $request->projectTitle;
        $project->startDate = Carbon::parse($request->startDate)->format('Y-m-d');
        $project->endDate = Carbon::parse($request->endDate)->format('Y-m-d');
        $project->save();

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks'])->with('update', 'Update Project Sucessful');
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

        $forums = Forum::where('project_id', $project->id)->orderByDesc('created_at')->get();
        $forums_reply = ForumReply::orderBy('created_at')->get();
        return view('project.detail', compact('project', 'statuses', 'files', 'tasks', 'users', 'head', 'user_tabs', 'task_members', 'users_department', 'project_members', 'task_user', 'forums', 'forums_reply'));
    }

    public function taskView(Project $project, Task $task) {

        $task = Task::where('id', $task->id)->first();


        return view('project.task.detail', compact('task'));
    }

    public function taskRemove(Project $project, Task $task)
    {
        $task_users = TaskUser::where('task_id', $task->id)->get();
        foreach($task_users as $task_user){
            $notification = new Notification();
            $notification-> notification_type_id = 4;
            $notification->project_id = $project->id;
            $notification->user_id = $task_user->user_id;
            $notification->status = 0;
            $notification->additional_description = $task->name;
            $notification->save();
        }

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

         DB::statement("ALTER TABLE notifications AUTO_INCREMENT =  1");
         $update = Notification::all();
         // Misalnya salah satu record di delete, id task akan tidak teratur
         // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
         $index = 1;
         foreach ($update as $key => $f) {
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

            $notification = new Notification();
            $notification-> notification_type_id = 2;
            $notification->user_id = $user;
            $notification->task_id = $task->id;
            $notification->status = 0;
            $notification->save();
        }

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks']);
    }

    public function addMember(Request $request, Project $project){

        // dd($request->users);
        $notification_all =  Notification::all();

        $users = $request->input('users');

        $project_users = ProjectUser::where('project_id', $project->id)->get();

        // dd($project_users);

        foreach($project_users as $project_user){
            $flag = 0;
            if($users!=null){
                foreach($users as $user){
                    if($user == $project_user->user_id){
                        $flag = 1;
                        break;
                    }
                }
            }
            if($flag == 0){
                $notification = new Notification();
                $notification->  notification_type_id = 3;
                $notification->user_id = $project_user->user_id;
                $notification->project_id = $project->id;
                $notification->status = 0;
                $notification->save();

                $tasks = Task::where('project_id', $project_user->project_id)->get();
                // dd($tasks);
                foreach($tasks as $task){
                    $task_users = TaskUser::where('project_id', $task->project_id)->where('task_id', $task->id)->get();
                    // dd($task_users);
                    // dd(count($task_users));
                    if(count($task_users)==1){
                        foreach($task_users as $task_user){
                            if($task_user->user_id == $project_user->user_id){
                                $task->delete();
                            }
                        }

                    }
                    else{
                        // foreach($task_users)
                        $task_users = TaskUser::where('task_id', $task->id)->where('user_id', $project_user->user_id)->where('project_id', $project_user->project_id)->first();
                        // dd($task_users);
                        if($task_users!=null){

                            $task_users->delete();
                        }
                    }
                }
            }
            $project_user->delete();
        }





        if($users==null){

        }
        else{
            foreach($users as $user){
                $flag = 0;
                foreach($project_users as $project_user){
                    if($project_user->user_id == $user){
                        $flag = 1;
                        break;
                    }
                }
                if($flag == 0){
                    $notification = new Notification();
                    $notification-> notification_type_id = 1;
                    $notification->user_id = $user;
                    $notification->project_id = $project->id;
                    $notification->status = 0;
                    $notification->save();
                }
            }
            foreach($users as $user){
                $project_users = new ProjectUser();
                $project_users->project_id = $project->id;
                $project_users->user_id = $user;
                $project_users->save();


                $flag = 0;


            }


        }




        // $project_users = ProjectUser::where('project_id', $project->id)->get();
        // foreach($project_users as $project_user){

        //     $notification = new Notification();
        //     $notification-> notification_type_id = 3;
        //     $notification->user_id = $project_user->user_id;
        //     $notification->assign_project_id = $project->id;
        //     $notification->status = 0;
        //     $notification->save();

        // }

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

        DB::statement("ALTER TABLE task_user AUTO_INCREMENT =  1");
        $updateTaskUser = TaskUser::all();
        // Misalnya salah satu record di delete, id task akan tidak teratur
        // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
        $index = 1;
        foreach ($updateTaskUser as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

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

        DB::statement("ALTER TABLE notifications AUTO_INCREMENT =  1");
         $update = Notification::all();
         // Misalnya salah satu record di delete, id task akan tidak teratur
         // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
         $index = 1;
         foreach ($update as $key => $f) {
             $f->id = $index;
             $index++;
             $f->save();
         }

        return redirect('projects/detail/'.$project->id. '/tasks')->with('addMember', 'Update Member Successfuly');

    }

    public function searchProject(Request $request){
        $search = $request->search;
        $filterStatus = $request->filterStatus;
        $statuses = Status::all();

       /*  if($search == null){
            return redirect('projects/index');
        } */
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
            if($filterStatus){
                $searches = Project::where('title', 'like', '%'.$search.'%')
                    ->where('status_id', $filterStatus)
                    ->paginate(10);
            }else{
                $searches = Project::where('title', 'like', '%'.$search.'%')->paginate(10);
            }
            $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
            return view('project.searchProject', compact('searches', 'search', 'id', 'statuses'));
        }
        if($filterStatus){
            $searches = Project::where('title', 'like', '%'.$search.'%')
                ->where('deptID', $deptID)
                ->where('status_id', $filterStatus)
                ->paginate(10);
        }else{
            $searches = Project::where('title', 'like', '%'.$search.'%')
                ->where('deptID', $deptID)
                ->paginate(10);
        }
        $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
        return view('project.searchProject', compact('searches', 'search', 'id', 'statuses'));
    }

    public function changeStatus(Project $project, Status $status){
        $project_users = ProjectUser::where('project_id', $project->id)->get();
        // dd($project_users);

        $head_dept = User::where('roleID', $project->deptID)->first();
        $notification = new Notification();
        $notification-> notification_type_id = 7;
        $notification->user_id = $head_dept->id;
        $notification->project_id = $project->id;
        $notification->status = 0;
        $notification->additional_description = $status->name;
        $notification->save();
        if(!empty($project_users)){
            foreach($project_users as $project_user){
                $notification = new Notification();
                $notification-> notification_type_id = 7;
                $notification->user_id = $project_user->user_id;
                $notification->project_id = $project->id;
                $notification->status = 0;
                $notification->additional_description = $status->name;
                $notification->save();
            }
        }

        $project->status()->associate($status);
        $project->save();




        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'tasks'])->with('status', 'Update Status Successful');
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

    public function deleteProject(Request $request, Project $project){

        // dd($request->user()->id);
        $notification = new Notification();
        $notification-> notification_type_id = 6;
        $notification->user_id = $request->user()->id;
        $notification->additional_description = "$project->title";
        $notification->status = 0;
        $notification->save();

        ProjectUser::where('project_id', $project->id)->delete();

        Project::destroy($project->id);

        // Update key dari Projects
        DB::statement("ALTER TABLE projects AUTO_INCREMENT =  1");
        $update = Project::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari Projects User
        DB::statement("ALTER TABLE projects AUTO_INCREMENT =  1");
        $update = ProjectUser::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari tasks
        DB::statement("ALTER TABLE tasks AUTO_INCREMENT =  1");
        $update = Task::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari tasks User
        DB::statement("ALTER TABLE task_user AUTO_INCREMENT =  1");
        $update = TaskUser::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari fORUMS Reply
        DB::statement("ALTER TABLE forums AUTO_INCREMENT =  1");
        $update = Forum::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari Forums Reply
        DB::statement("ALTER TABLE forum_reply AUTO_INCREMENT =  1");
        $update = ForumReply::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        // Update key dari Notificatioons Reply
        DB::statement("ALTER TABLE notifications AUTO_INCREMENT =  1");
        $update = Notification::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }


        return redirect('projects/index')->with('delete', 'Project sucessfull deleted');
    }


    public function forum(Request $request, Project $project){


        $request->validate([
            'description' => 'required|min:3',
        ]);

        $forum = new Forum();
        $forum->project_id = $project->id;
        $forum->user_id = FacadesAuth::user()->id;
        $forum->description = $request->description;
        // dd($forum);
        $forum->save();

        $forum = Forum::where('user_id', FacadesAuth::user()->id)->orderByDesc('created_at')->first();
        // dd($forum);
        if(FacadesAuth::user()->roleID == 2 || FacadesAuth::user()->roleID == 3 ||
        FacadesAuth::user()->roleID == 4 || FacadesAuth::user()->roleID == 5 || FacadesAuth::user()->roleID == 6){
            $project_users = ProjectUser::where('project_id', $project->id)->get();
            foreach($project_users as $project_user){
                $notification = new Notification();
                $notification->notification_type_id = 8;
                $notification->user_id = $project_user->user_id;
                $notification->forum_id = $forum->id;
                $notification->status = 0;
                $notification->additional_description = $request->description;
                $notification->save();
            }
        }

        // $forum_reply->user_id =

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'forum'])->with('post_success', 'Post Successful');
    }

    public function forum_delete(Request $request, Project $project){


        // dd($request->forum_id);
        $forum = Forum::where('id', $request->forum_id)->first();

        $forum_reply = ForumReply::where('forum_id', $forum->id)->get();

        if($forum_reply->isNotEmpty()){
            foreach($forum_reply as $reply){
                $reply->delete();
            }

            DB::statement("ALTER TABLE forum_reply AUTO_INCREMENT =  1");
            $updateForumReply = ForumReply::all();
            // Misalnya salah satu record di delete, id task akan tidak teratur
            // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
            $index = 1;
            foreach ($updateForumReply as $key => $f) {
                $f->id = $index;
                $index++;
                $f->save();
            }
        }


        $forum = $forum->delete();

        DB::statement("ALTER TABLE forums AUTO_INCREMENT =  1");
        $updateForum = Forum::all();
        // Misalnya salah satu record di delete, id task akan tidak teratur
        // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
        $index = 1;
        foreach ($updateForum as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        DB::statement("ALTER TABLE notifications AUTO_INCREMENT =  1");
        $update = Notification::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'forum'])->with('post_delete', 'Post Successful Deleted');
    }

    public function reply(Request $request, Project $project, Forum $forum){


        $request->validate([
            'description' => 'required|min:3',
        ]);

        $forum_reply = new ForumReply();
        $forum_reply->forum_id = $request->forum_id;
        $forum_reply->user_id = FacadesAuth::user()->id;
        $forum_reply->description = $request->description;
        $forum_reply->save();

        $forum = Forum::where('id', $request->forum_id)->first();
        if($forum->user_id != FacadesAuth::user()->id){
            $notification = new Notification();
            $notification->notification_type_id = 9;
            $notification->user_id = $forum->user_id;
            $notification->forum_id = $forum->id;
            $notification->status = 0;
            $notification->additional_description = "( " . FacadesAuth::user()->name . " ) ". $request->description;
            $notification->save();
        }


        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'forum'])->with('post_reply', 'Post Successful Replied');
    }

    public function forum_reply_delete(Request $request, Project $project){


        // dd($request->forum_reply_id);
        $forum_reply = ForumReply::where('id', $request->forum_reply_id)->first();
        $forum_reply->delete();



        DB::statement("ALTER TABLE forum_reply AUTO_INCREMENT =  1");
        $updateForumReply = ForumReply::all();
        // Misalnya salah satu record di delete, id task akan tidak teratur
        // Mengatasinya dengan update id dimana index nya dimulai dari 1 lagi
        $index = 1;
        foreach ($updateForumReply as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        DB::statement("ALTER TABLE notifications AUTO_INCREMENT =  1");
        $update = Notification::all();
        $index = 1;
        foreach ($update as $key => $f) {
            $f->id = $index;
            $index++;
            $f->save();
        }

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'forum'])->with('post_delete', 'Reply Successful Deleted');
    }
}
