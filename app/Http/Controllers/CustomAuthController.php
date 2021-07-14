<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomAuthController extends Controller
{
    public function homeAdmin()
    {
        return view('admin.login');
    }  

    public function homeTeacher()
    {
        return view('teacher.login');
    }  
      
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role_id' => 1])) {
            return redirect()->intended('dashboard-admin');
        }
  
        return redirect("admin-home");
    }

    public function teacherLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role_id' => 2])) {
            return redirect()->intended('dashboard-teacher');
        }
  
        return redirect("teacher-home");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin-home');
    }
}