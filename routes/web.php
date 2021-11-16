<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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
Route::get('/user/{user}/{user_tabs}', [AdminController::class, 'show']);
Route::patch('/admin/editUser/{username}', [AdminController::class, 'update'])->Middleware('CheckAdmin');

Route::get('/user/index', [HDeptController::class, 'index']);

Route::prefix('projects')->group(function () {
    Route::get('/index', [ProjectController::class, 'show'])->name('projects');
    Route::get('/add', [ProjectController::class, 'add']);
    Route::post('/addProject', [ProjectController::class, 'add_project'])->name('add_project');
});

// Route::post('/change_profile_picture/{id}', [AdminController::class, 'show'], function ($id, Request $request) {

    
// });

Route::post('/update/profile_picture/{id}', [AdminController::class, 'update_pp']);

