<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Backend\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/backend';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $creds = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        $rememberMe = $request->has('remember_me');
        if (auth('admin')->attempt($creds, $rememberMe)) {
            return redirect()->route('backend.home')->with('alert-success','تم تسجيل الدخول بنجاح');
        }
        return redirect()->back()->with('alert-danger',"البريد الإلكتروني وكلمة المرور غير متطابقين");
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        return redirect()->route('backend.show.login.form');
    }

    protected function loggedOut()
    {
        return redirect()->route('backend.show.login.form');
    }

}
