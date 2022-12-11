<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $creds = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        $rememberMe = $request->has('remember_me');
        if (auth('web')->attempt($creds, $rememberMe)) {
            return redirect()->route('frontend.home')->with('alert-success',trans('tr.You have signed in successfully'));
        }

        return redirect()->back()->with('alert-danger',trans('tr.The email and password do not match'));
    }

    protected function logout()
    {
        auth()->guard('web')->logout();
        return redirect()->route('frontend.home')->with('alert-success', 'Logged Out successfully');
    }
}
