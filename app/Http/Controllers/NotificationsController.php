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
}
