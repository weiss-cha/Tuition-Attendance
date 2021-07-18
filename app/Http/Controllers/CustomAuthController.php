<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class CustomAuthController extends Controller
{
    //Login Page for Admin
    public function homeAdmin()
    {
        return view('admin.login');
    }  

    //Login Page for Teacher
    public function homeTeacher()
    {
        return view('teacher.login');
    }  
      
    //After Clicking Login Button
    public function adminLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
   
        //Obtain Input
        $name = $request->name;
        $password = $request->password;

        //role_id: Admin = 1 
        //Redirect to 'Add Teacher' Page if Logged in
        if (Auth::attempt(['name' => $name, 'password' => $password, 'role_id' => 1])) {
            return redirect()->intended('dashboard-admin');
        }
  
        return redirect("admin-home");
    }

    //After Clicking Login Button
    public function teacherLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
   
        //Obtain Input
        $name = $request->name;
        $password = $request->password;

        //role_id: Teacher = 2
        //Redirect to 'Attendance' Page if Logged in
        if (Auth::attempt(['name' => $name, 'password' => $password, 'role_id' => 2])) {

            //Obtain Dropdown List Option (Assigned Class)
            $classList = DB::table("{$name}")->select('class_name')->get(); 
            return view('teacher.dashboard')->with('classList', $classList)->with('name', $name);
        }
  
        return redirect("teacher-home");
    }

    //After Clicking 'Logout' on Navigation Bar
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin-home');
    }
}