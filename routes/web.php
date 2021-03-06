<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HDivController;
use App\Http\Controllers\HDeptController;
use App\Http\Controllers\MDeptController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProjectController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

ROute::patch('/password/reset', [AdminController::class, 'resetPassword'])->name('resetPassword');

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/admin/index', [HDeptController::class, 'index'])->middleware('CheckAdmin');
Route::get('/admin/create', [AdminController::class, 'create'])->Middleware('CheckAdmin');
Route::post('/admin/addUser', [AdminController::class, 'store'])->Middleware('CheckAdmin');
Route::delete('/admin/{username}/delete', [AdminController::class, 'destroy'])->Middleware('CheckAdmin');
Route::get('/admin/{username}/edit', [AdminController::class, 'edit']);
Route::get('/admin/{user:username}/editPassword', [AdminController::class, 'editPassword']);
Route::patch('/admin/{user:username}/changePassword', [AdminController::class, 'changePassword']);
Route::get('/admin/{user:username}/changePassword', [AdminController::class, 'editPassword']);
Route::get('/user/{user}/{user_tabs}', [AdminController::class, 'show']);
Route::patch('/admin/editUser/{username}', [AdminController::class, 'update']);

Route::get('/user/index', [HDeptController::class, 'index']);

// Notif
Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');

Route::get('/notifications/mark_as_read/{notification_id}', [NotificationsController::class, 'markAsRead']);
Route::get('/notifications/mark_all_notification', [NotificationsController::class, 'markAsReadAll'])->name('markAsReadAll');
Route::get('/notifications/delete_all_notification', [NotificationsController::class, 'deleteAllRead'])->name('deleteAllRead');

Route::prefix('projects')->group(function () {
    Route::get('/index', [ProjectController::class, 'index'])->name('projects');
    Route::get('/add', [ProjectController::class, 'add'])->name('add_project_view');
    Route::post('/addProject', [ProjectController::class, 'addProject'])->name('add_project');
    Route::get('/editProject/{project}', [ProjectController::class, 'editProjectView'])->name('edit_project_view');
    Route::put('/editProject/post/{project}', [ProjectController::class, 'editProject'])->name('edit_project');
    Route::get('/changeStatus/{project}/{status}', [ProjectController::class, 'changeStatus'])->name('change_project_status');

    Route::get('/detail/{project}/{user_tabs}', [ProjectController::class, 'detailView'])->name('project_detail_view');
    Route::get('/detail/{project}/{task}', [ProjectController::class, 'taskView'])->name('project_task_view');
    Route::post('/detail/{project}/{task}/remove', [ProjectController::class, 'taskRemove']);
    Route::post('/detail/{project}/{task}/change_task_status', [ProjectController::class, 'taskChangeStatus']);

    Route::post('/detail/{project}/forum', [ProjectController::class, 'forum']);
    Route::post('/detail/{project}/forum/{forum_id}/reply', [ProjectController::class, 'reply']);
    Route::get('/detail/{project}/forum/delete/{forum_id}', [ProjectController::class, 'forum_delete']);
    Route::get('/detail/{project}/forum_reply/delete/{forum_reply_id}', [ProjectController::class, 'forum_reply_delete']);

    Route::post('/file/add/{project}', [FileController::class, 'addFile'])->name('add_file');
    Route::delete('/file/delete/{project}', [FileController::class, 'deleteFile'])->name('delete_file');
    Route::get('/file/download', [FileController::class, 'downloadFile'])->name('download_file');


    Route::get('/searchProject', [ProjectController::class, 'searchProject'])->name('searchProject');
    Route::get('/status/{status}', [ProjectController::class, 'projectStatus'])->name('projectStatus');
});
Route::delete('/deleteProject/{project}', [ProjectController::class, 'deleteProject'])->name('deleteProject');

Route::post('/projects/addMember/{project}', [ProjectController::class, 'addMember'])->name('addMember');

Route::prefix('task')->group(function () {
    Route::get('/add/{project}', [ProjectController::class, 'addTaskView'])->name('add_task_view');
    Route::post('/addTask/{project}', [ProjectController::class, 'addTask'])->name('add_task');
    Route::post('/update_task/{task}', [ProjectController::class, 'updateTask'])->name('update_task');
});

// Route::post('/change_profile_picture/{id}', [AdminController::class, 'show'], function ($id, Request $request) {


// });

Route::post('/update/profile_picture/{id}', [AdminController::class, 'update_pp']);

Route::get('/department/{role}', [HDeptController::class, 'deptUser']);

Route::get('/department', [DepartmentController::class, 'index']);

Route::get('/department/{type}', [DepartmentController::class, 'type']);

Route::get('/searchUser', [AdminController::class, 'searchUser']);
