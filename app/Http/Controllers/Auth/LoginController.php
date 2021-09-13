<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    // protected $redirectTo = RouteServiceProvider::HOME;
 protected function authenticated()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.support.tickers');

        } elseif (Auth::user()->hasRole('customer')) {
            if(Auth::user()->lead == 1){
                return redirect()->route('payment');
            }else{
                return redirect()->route('customer.support.tickers');
            }

        } elseif(Auth::user()->hasRole('employee1|employee2')) {
             return redirect()->route('employee.index');

        }else{
            return redirect()->route('home');
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
