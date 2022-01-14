<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class HDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('RoleID', '!=', 1)->paginate(10);
        $div = User::where('RoleID', '!=', 1)->where('RoleID', '!=', 2)->paginate(10);
        $id = ($users->currentpage() - 1) * $users->perpage() + 1;
        $dept1 = User::where('RoleID', 3)->orWhere('RoleID', 7)->paginate(10);
        $dept2 = User::where('RoleID', 4)->orWhere('RoleID', 8)->paginate(10);
        $dept3 = User::where('RoleID', 5)->orWhere('RoleID', 9)->paginate(10);
        $dept4 = User::where('RoleID', 6)->orWhere('RoleID', 10)->paginate(10);
        $roles = Role::where('id', 3)->orWhere('id', 4)->orWhere('id', 5)->orWhere('id', 6)->get();

        return view('user.index', compact('users' ,'dept1', 'dept2', 'dept3', 'dept4', 'id', 'roles', 'div'));
    }

    public function deptUser(Role $role)
    {
        $users = User::where('RoleID', '!=', 1)->where('RoleID', '!=', 2)->where('RoleID', $role->id)->orWhere('RoleID', ($role->id + 4))->paginate(10);
        $id = ($users->currentpage() - 1) * $users->perpage() + 1;
        $dept1 = User::where('RoleID', 3)->orWhere('RoleID', 7)->paginate(10);
        $dept2 = User::where('RoleID', 4)->orWhere('RoleID', 8)->paginate(10);
        $dept3 = User::where('RoleID', 5)->orWhere('RoleID', 9)->paginate(10);
        $dept4 = User::where('RoleID', 6)->orWhere('RoleID', 10)->paginate(10);
        $roles = Role::where('id', 3)->orWhere('id', 4)->orWhere('id', 5)->orWhere('id', 6)->get();

        return view('user.deptUser', compact('users', 'roles', 'role', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
