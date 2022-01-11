<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HDivController;
use App\Http\Controllers\HDeptController;
use App\Http\Controllers\MDeptController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/index', [AdminController::class, 'index'])->middleware('CheckAdmin');
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

Route::prefix('projects')->group(function () {
    Route::get('/index', [ProjectController::class, 'show'])->name('projects');
    Route::get('/add', [ProjectController::class, 'add'])->name('add_project_view');
    Route::post('/addProject', [ProjectController::class, 'addProject'])->name('add_project');
    Route::get('/detail/{project}/{user_tabs}', [ProjectController::class, 'detailView'])->name('project_detail_view');
    Route::get('/detail/{project}/{task}', [ProjectController::class, 'taskView'])->name('project_task_view');
});
Route::post('/projects/addMember/{project}', [ProjectController::class, 'addMember'])->name('addMember');

Route::prefix('task')->group(function () {
    Route::get('/add/{project}', [ProjectController::class, 'addTaskView'])->name('add_task_view');
    Route::post('/addTask/{project}', [ProjectController::class, 'addTask'])->name('add_task');
});

// Route::post('/change_profile_picture/{id}', [AdminController::class, 'show'], function ($id, Request $request) {

    
// });

Route::post('/update/profile_picture/{id}', [AdminController::class, 'update_pp']);

Route::get('/department', [DepartmentController::class, 'index']);

Route::get('/department/{type}', [DepartmentController::class, 'type']);

Route::get('/searchUser', [AdminController::class, 'searchUser']);
Route::get('/searchProject', [ProjectController::class, 'searchProject']);
