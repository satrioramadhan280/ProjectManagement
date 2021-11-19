<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserActive;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    // Users Active When Login
    protected function authenticated(Request $request, $user)
    {
        //
        $current_date_time = date('Y-m-d H:i:s');
        $date_only = date('Y-m-d');

        $curr_user = User::where('username', $request->username)->first();
        // dd($curr_user);
        $useractiveall = UserActive::all();
        $useractivecurr = UserActive::where('user_id', $curr_user->id)->get();
        
        // dd($useractive->created_at->format('Y-m-d'));
        if($useractiveall==null){
            $useractiveobj = new UserActive();
            $useractiveobj->user_id = $curr_user->id;
            $useractiveobj->roleID = $curr_user->roleID;
            $useractiveobj->created_at = $current_date_time;
            $useractiveobj->save();
        }
        else{
            // dd('hello');
            $point = 0;
            foreach($useractivecurr as $x){
                if($x->created_at->format('Y-m-d') == $date_only){
                    $point = 1;
                    break;
                }
            }
            if($point==0){
                $useractiveobj = new UserActive();
                $useractiveobj->user_id = $curr_user->id;
                $useractiveobj->roleID = $curr_user->roleID;
                $useractiveobj->created_at = $current_date_time;
                $useractiveobj->save();
            }
            
        }
    }
}
