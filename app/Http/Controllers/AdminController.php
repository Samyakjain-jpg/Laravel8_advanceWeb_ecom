<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function makelogin(Request $request) 
    {
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
            'role'=>'admin'
        );
        if(Auth::attempt($data))
        {
            return redirect()->route('admin.dashboard');
        }
        else{
            return back()->withErrors(['message'=>'invalid email or password']);
        }
    }
  
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
