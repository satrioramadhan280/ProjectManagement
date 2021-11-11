<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;
        $dept1 = User::where('RoleID', 3)->orWhere('RoleID', 7)->paginate(5);
        $dept2 = User::where('RoleID', 4)->orWhere('RoleID', 8)->paginate(5);
        $dept3 = User::where('RoleID', 5)->orWhere('RoleID', 9)->paginate(5);
        $dept4 = User::where('RoleID', 6)->orWhere('RoleID', 10)->paginate(5);
        return view('user.index', compact('dept1', 'dept2', 'dept3', 'dept4', 'id'));
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
