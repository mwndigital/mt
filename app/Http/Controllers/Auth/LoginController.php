<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected function redirectTo(){
        // Custom redirect after login
        $redirectParam = request()->query('redirect');
        if($redirectParam) return route($redirectParam);

        if($this->guard()->user()->hasRole(['super admin', 'admin', 'staff'])){
            return route('admin.dashboard');
        }
        elseif($this->guard()->user()->hasRole('customer')){
            return route('customer.dashboard');
        }
        else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
