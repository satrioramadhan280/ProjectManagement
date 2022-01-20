<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        return view('notifications', compact('notifications', 'notification_types', 'users', 'projects', 'tasks'));
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
}
