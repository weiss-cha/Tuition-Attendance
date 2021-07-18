<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

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
            'name' => 'required',
            'password' => 'required',
        ]);
   
        $name = $request->name;
        $password = $request->password;
        if (Auth::attempt(['name' => $name, 'password' => $password, 'role_id' => 1])) {
            return redirect()->intended('dashboard-admin');
        }
  
        return redirect("admin-home");
    }

    public function teacherLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
   
        $name = $request->name;
        $password = $request->password;
        if (Auth::attempt(['name' => $name, 'password' => $password, 'role_id' => 2])) {
            $classList = DB::table("{$name}")->select('class_name')->get();
            return view('teacher.dashboard')->with('classList', $classList)->with('name', $name);
        }
  
        return redirect("teacher-home");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin-home');
    }
}