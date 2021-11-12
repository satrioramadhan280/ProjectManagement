<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use DateTime;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;
        $users = User::where('roleID', '!=', 1)->paginate(5);
        return view('admin.index', compact('users', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', 'like', '%MemberDepartment%')->get();
        return view('admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = new User;

        $date = new DateTime();
        $date->format('Y-m-d');

        $users->firstName = $request->firstName;
        $users->lastName = $request->lastName;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = bcrypt('simas123');
        $users->photo = 'photo-profile.png';
        $users->roleID = $request->roleID;
        $users->dateofBirth = Carbon::parse($request->myDate);

        $users->save();

        return redirect('/admin/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username, $user_tabs)
    {
        $user = User::where('username', $username)->first();
        $role = Role::find($user->roleID);
        // dd($role);
        return view('admin.detail', compact('user', 'user_tabs', 'role'));
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


    // Numpang buat Controller User
    public function update_pp($id, Request $request){
        // dd($request->photo);

    
        $user = User::where('id', $id)->first();
        // dd($user);

        $request->validate([
            'photo' => 'mimes:jpg,bmp,png'
        ]);


        $user->photo = 'dsadsadsa.png';
        if($request->photo == null){
            
        }

        // Else nya akan membuat path untuk image yg diupload disimpan dalam public
        else{
            // dd($request);
            $imgPath = $request->file('photo')->store('img/users_photo', 'public');
            // $request->file('image')->store('img/users_photo', 'public');
            $file_name = basename($imgPath);
            $user->photo = $file_name;
        }
        $user->save();

        // $username = $user->username;

        return redirect()->back();
    }

}
