<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //

    function index(){
        $user = User::all();
        $department1 = User::where('roleID', 7)->orWhere('roleID', 3)->get();
        $department2 = User::where('roleID', 8)->orWhere('roleID', 4)->get();
        $department3 = User::where('roleID', 9)->orWhere('roleID', 5)->get();
        $department4 = User::where('roleID', 10)->orWhere('roleID', 6)->get();
        $role = Role::all();
        return view('department', compact('user', 'department1', 'department2', 'department3', 'department4', 'role'));
    }

    function type($type){

        // dd($type);
        $role = Role::where('display', $type)->first();
        

        $user = User::all();
        $user = User::where('roleID', $role->id)->orWhere('roleID', $role->id-4)->paginate(5);

        $role = Role::all();
        return view('department_type', compact('user', 'role'));
    }
}
