<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $TotalUsers = User::where('roleID', '!=', 1)->count();
        $TotalDept1 = User::where('RoleID', 7)->orWhere('RoleID', 3)->count();
        $TotalDept2 = User::where('RoleID', 8)->orWhere('RoleID', 4)->count();
        $TotalDept3 = User::where('RoleID', 9)->orWhere('RoleID', 5)->count();
        $TotalDept4 = User::where('RoleID', 10)->orWhere('RoleID', 6)->count();
        return view('home', compact('TotalUsers', 'TotalDept1', 'TotalDept2', 'TotalDept3', 'TotalDept4'));
    }
}
