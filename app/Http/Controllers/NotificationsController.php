<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    //
    public function index(){
        $notifications = Notification::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        // dd($notifications);
        $notification_types = NotificationType::all();
        $users = User::all();
        $projects = Project::all();
        $tasks = Task::all();
        $forums = Forum::all();
        $roles = Role::all();
        
        
        return view('notifications', compact('notifications', 'notification_types', 'users', 'projects', 'tasks', 'forums', 'roles'));
    }

    

    public function markAsRead(Request $request){

        // dd($request->notification_id);
        $notification = Notification::where('id', $request->notification_id)->first();
        $notification->status = 1;
        $notification->save();
        
        return redirect('notifications');
    }

    public function markAsReadAll(){

        // dd($request->notification_id);
        $notifications = Notification::where('user_id', Auth::user()->id)->where('status', 0)->get();

        foreach($notifications as $notification){
            $notification->status = 1;
            $notification->save();
        }
        
        
        return redirect('notifications');
    }

    public function deleteAllRead(){

        // dd($request->notification_id);
        $notifications = Notification::where('user_id', Auth::user()->id)->where('status', 1)->get();

        foreach($notifications as $notification){
            $notification->delete();
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
        
        return redirect('notifications');
    }
    
}
