<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use DateTime;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'dateOfBirth' => 'required|before:today',
            'roleID' => 'required| gt:0'
        ]);

        $users = new User;

        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = bcrypt('xyz12345');
        $users->photo = 'photo-profile.png';
        $users->roleID = $request->roleID;
        $users->dateOfBirth = Carbon::parse($request->dateOfBirth);

        $users->save();


        return redirect('/user/index')->with('create', $users->name.' has been registered. Default password: xyz12345');
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

        if($user->roleID == 7){
            $deptID = 3;
        }
        else if($user->roleID == 8){
            $deptID = 4;
        }
        else if($user->roleID == 9){
            $deptID = 5;
        }
        else if($user->roleID == 10){
            $deptID = 6;
        }
        else{
            $deptID = 0;
        }

        $projects = Project::join('project_user', 'projects.id', '=', 'project_user.project_id')
            ->where('projects.deptID', $deptID)
            ->where('project_user.user_id', $user->id)->paginate(10);
        $id = ($projects->currentpage() - 1) * $projects->perpage() + 1;


        return view('admin.detail', compact('user', 'user_tabs', 'role', 'projects', 'id'));
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
        $dob = Carbon::parse($user->dateOfBirth)->format('d-m-Y');

        return view('admin.edit', compact('user', 'roles', 'dob'));
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


        $currUser = User::where('username', $user)->first();

        if($request->username != $currUser->username){
            $request->validate([
                'username' => 'required|string|min:6|unique:users',
            ]);
        }

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
            return redirect('/user/index')->with('update', 'Profile has been updated!');
        }
        if($currUser->roleID != 1){
            User::where('id', $currUser->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'dateOfBirth' => Carbon::parse($request->dateOfBirth)->format('Y-m-d'),
            ]);
        }

        return redirect('/user/'.$request->username.'/about')->with('update', 'Profile has been updated!');
    }

    public function editPassword($user){
        $user = User::where('username', $user)->first();
        return view('admin.changePassword', compact('user'));
    }

    public function changePassword(Request $request,  $user){
        
        $user_col = User::where('username', $user)->first();
        
        
        
        $request->validate([
            // 'currentPassword' => 'required|not_in:' . $user->password,
            'currentPassword' => ['required', function ($attribute, $value, $fail) use ($user_col, $request) {
                if (!Hash::check($request->currentPassword, $user_col->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'newPassword' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|min:8|same:newPassword'
        ]);

        
        if(Hash::check($request->currentPassword, $user_col->password)){
            // dd('pass sama nih');
            User::where('username', $user)->update([
                'password' => bcrypt($request->newPassword)
            ]);
        }
        
        
 

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
        return redirect('/user/index')->with('delete', 'Delete User Successful');
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
        $filterDept = $request->filterDept;

        /* if($search == null){
            return redirect('/user/index');
        } */
        if(auth()->user()->roleID == 1){
            if($filterDept){
                $searches = User::where('name', 'like', '%'.$search.'%')
                ->where('roleID', '!=', '1')
                ->whereIn('roleID', [$filterDept, $filterDept + 4])
                ->paginate(10);
            }else{
                $searches = User::where('name', 'like', '%'.$search.'%')
                ->where('roleID', '!=', '1')
                ->paginate(10);
            }
        }
        else if(auth()->user()->roleID == 2){
            if($filterDept){
                $searches = User::where('name', 'like', '%'.$search.'%')
                ->where('roleID', '!=', '1')
                ->whereIn('roleID', [$filterDept, $filterDept + 4])
                ->paginate(10);
            }else{
                $searches = User::where('name', 'like', '%'.$search.'%')
                ->where('roleID', '!=', '1')
                ->paginate(10);
            }
        }
        else if(auth()->user()->roleID == 3 || auth()->user()->roleID == 7){
            $list = [3, 7];
            $searches = User::where('name', 'like', '%'.$search.'%')
            ->where('roleID', '!=', 1)
            ->where('roleID', '!=', 2)
            ->whereIn('roleID', $list)
            ->paginate(10);
        }
        else if(auth()->user()->roleID == 4 || auth()->user()->roleID == 8){
            $list = [4, 8];
            $searches = User::where('name', 'like', '%'.$search.'%')
            ->where('roleID', '!=', 1)
            ->where('roleID', '!=', 2)
            ->whereIn('roleID', $list)
            ->paginate(10);
        }
        else if(auth()->user()->roleID == 5 || auth()->user()->roleID == 9){
            $list = [5, 9];
            $searches = User::where('name', 'like', '%'.$search.'%')
            ->where('roleID', '!=', 1)
            ->where('roleID', '!=', 2)
            ->whereIn('roleID', $list)
            ->paginate(10);
        }
        else if(auth()->user()->roleID == 6 || auth()->user()->roleID == 10){
            $list = [6, 10];
            $searches = User::where('name', 'like', '%'.$search.'%')
            ->where('roleID', '!=', 1)
            ->where('roleID', '!=', 2)
            ->whereIn('roleID', $list)
            ->paginate(10);
        }

        $id = ($searches->currentpage() - 1) * $searches->perpage() + 1;
        $roles = Role::where('id', 3)->orWhere('id', 4)->orWhere('id', 5)->orWhere('id', 6)->get();
        return view('user.searchUser', compact('searches', 'search', 'id', 'roles'));
    }

    public function resetPassword(Request $request){
        $username = $request->username;
        $dateOfBirth = $request->dateOfBirth;

        $request->validate([
            'username' => 'required',
            'dateOfBirth' => 'required|before:today'
        ]);


        $currUser = User::where('username', $username)->where('dateOfBirth', $dateOfBirth)->first();
        $passwordDate = Carbon::parse($currUser->dateOfBirth)->format('dmy');
        if($currUser != null){
            $currUser = User::where('username', $username)->where('dateOfBirth', $dateOfBirth)->update([
                'password' => bcrypt('!Bp4'.$passwordDate)
            ]);
            return redirect('/')->with('changePassword', 'Reset Password Successfull. Password : !Bp4yymmdd based on your date of birth');
        }
        else{
            return redirect('/password/reset')->with('fail', 'These credentials do not match our records.');
        }
    }
}
