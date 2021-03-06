<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo(){
        if (Auth::user()->hasRole('sadmin')) {
           $this->redirectTo = route('super_admin.home.index');
           return $this->redirectTo;
        }elseif (Auth::user()->hasRole('iadmin')) {
            $this->redirectTo = route('admin.home.index');
            return $this->redirectTo;
        }elseif (Auth::user()->hasRole('employer')) {
            $this->redirectTo = route('employer.home.index');
            return $this->redirectTo;
        }else {
            $this->redirectTo = route('alumni.home.index');
            return $this->redirectTo;
        }
    }
}
