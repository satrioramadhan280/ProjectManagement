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
        $TotalDept1 = User::where('RoleID', 7)->orWhere('RoleID', 1)->count();
        return view('home', compact('TotalUsers', 'TotalDept1'));
    }
}
