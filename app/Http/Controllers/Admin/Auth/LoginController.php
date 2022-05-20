<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        
        //$this->middleware('guest')->except('logout');
        if ($request->getMethod() == 'GET' && Auth::check()==false) {
            // dd(Auth::check());
            return view('admin.auth.login');
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials) ) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withInput();
        }
    }
    

}
