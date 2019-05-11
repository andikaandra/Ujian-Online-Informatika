<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = 'tcexam/mahasiswa';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginPage() {
        return view('auth.login');
    }

    public function login(Request $request) {
      // return $request;
        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password
        );
    // return $userdata;
        if (Auth::attempt($userdata)) {
            if (Auth::user()->role == "mahasiswa") {
                return redirect('tcexam/mahasiswa');
            } elseif(Auth::user()->role == "dosen") {
                return redirect('tcexam/dosen');
            }
        } else {
            return redirect('login')->with('message', "Account not found");
        }
    }
}
