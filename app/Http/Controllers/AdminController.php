<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use DateTime;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('roleID', '!=', 1)->sortable(['name', 'Name'])->paginate(5);
        $id = ($users->currentpage() - 1) * $users->perpage() + 1;
        return view('admin.index', compact('users', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Admin')->get();
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
        $request->validate([
            'name' => 'required|string|min:3',
            'username' => ['required', 'string', 'min:6', 'unique:users'],
            'email' => 'required|min:5|unique:users',
            'dateOfBirth' => 'before:today',
            'roleID' => 'required| gt:0'
        ]);

        $users = new User;

        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = bcrypt('simas123');
        $users->photo = 'photo-profile.png';
        $users->roleID = $request->roleID;
        $users->dateOfBirth = Carbon::parse($request->dateOfBirth);

        $users->save();


        return redirect('/admin/index')->with('create', $users->name.' has been registered. Default password: simas123');
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
        return view('admin.detail', compact('user', 'user_tabs', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $roles = Role::where('name', '!=', 'Admin')->get();
        $user = User::where('username', $user)->first();

        return view('admin.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'dateOfBirth' => 'before:today',
        ]);
           
        if($request->username != $user){        
            $request->validate([
                'username' => 'required|string|min:6|unique:users'
            ]);
        }
        
        $currUser = User::where('username', $user)->first();
        
        if($request->email != $currUser->email){     
            $request->validate([
                'email' => 'required|string|min:6|unique:users'
            ]);
        }


        if(Auth::user()->roleID == 1){
            User::where('id', $currUser->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'dateOfBirth' => Carbon::parse($request->dateOfBirth)->format('Y-m-d'),
                'roleID' => $request->roleID
            ]);
            return redirect('/admin/index')->with('update', 'User has been updated!');
        }
        if($currUser->roleID != 1){
            User::where('id', $currUser->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'dateOfBirth' => Carbon::parse($request->dateOfBirth)->format('Y-m-d'),
            ]);
        }
        
        return redirect('/user/'.$currUser->username.'/about')->with('update', 'User has been updated!');
    }
    
    public function editPassword($user){
        $user = User::where('username', $user)->first();
        return view('admin.changePassword', compact('user'));
    }

    public function changePassword(Request $request,  $user){
        $request->validate([
            'newPassword' => 'required|min:8',
            'password_confirmation' => 'required|password|min:8|same:newPassword'
        ]);

        User::where('username', $user)->update([
            'password' => bcrypt($request->newPassword)
        ]);

        return redirect('/user/'.$user.'/about')->with('password', 'Change Password successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $user = User::where('username', $username)->first();
        User::destroy($user->id);
        return redirect('admin/index')->with('delete', 'Delete User Successful');
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
            $imgPath = $request->file('photo')->store('users_photo');
            // $request->file('image')->store('img/users_photo', 'public');
            $file_name = basename($imgPath);
            $user->photo = $file_name;
        }
        $user->save();

        // $username = $user->username;

        return redirect()->back();
    }

    public function searchUser(Request $request){
        $search = $request->search;
        $searches = User::where('name', 'like', '%'.$search.'%')->paginate(5);
        $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
        return view('user.searchUser', compact('searches', 'search', 'id'));
    }
}
