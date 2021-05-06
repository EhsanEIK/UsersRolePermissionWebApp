<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        //Validate Login data
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        //Attempt to Login
        //$data = $request->only(['email', 'password']);
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
            //Redirect to Dashboard
            Session::flash('message', 'Successfully Logged In!');
            return redirect()->to(route('welcome'));
        }
        else{
            if(Auth::guard('admin')->attempt(['user_name'=>$request->email, 'password'=>$request->password], $request->remember)){
                //Redirect to Dashboard
                Session::flash('message', 'Successfully Logged In!');
                return redirect()->to(route('welcome'));
            }
            //error
            return back()->withErrors('Sorry! Invalid email or password!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
