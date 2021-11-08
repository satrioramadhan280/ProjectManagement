<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;

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
Route::get('/admin/index', [AdminController::class, 'index']);
Route::get('/admin/create', [AdminController::class, 'create']);
Route::get('/{user}', [AdminController::class, 'show']);

Route::prefix('projects')->group(function () {
    Route::get('/index', [ProjectController::class, 'show'])->name('projects');
    Route::get('/add', [ProjectController::class, 'add']);
});
