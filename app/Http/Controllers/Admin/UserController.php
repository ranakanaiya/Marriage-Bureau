<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        if(auth()->check())
            return redirect()->route('admin.dashboard');
        return view('admin.login');
    }

    public function loginAttempt(Request $request)
    {
         $request->validate([
            'email'=>'required|exists:users,email',
            'password'=>'required|min:6'],[
            'email.exists'=>'Email not Registered']);

         if(auth()->attempt($request->only(['email','password'])))
         {
            return redirect()->route('admin.dashboard')->with(['status'=>'success','message'=>'Login Successful']);
         }
         return back()->with(['status'=>'error','message'=>'Credentials did not matched']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login')->with(['status'=>'success','message'=>'Logout Successful']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
