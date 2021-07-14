<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
   
        $email = $request->input('email');
        $password = $request->input('password');
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
   
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role_id' => 2])) {
            return redirect()->intended('dashboard-teacher');
        }
  
        return redirect("teacher-home");
    }
    
    public function dashboardAdmin()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
  
        return redirect("admin-home");
    }

    public function dashboardTeacher()
    {
        if(Auth::check()){
            return view('teacher.dashboard');
        }
  
        return redirect("teacher-home");
    }
    
    public function customTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
           
        $teacher = $request->all();
        $check = $this->addTeacher($teacher);
         
        return redirect("dashboard-admin");        
    }

    public function addTeacher(array $teacher)
    {
        return User::create([
            'name' => $teacher['name'],
            'email' => $teacher['email'],
            'password' => Hash::make($teacher['password']),
            'role_id' => 2
        ]);
    }

    public function classTeacher()
    {
        if(Auth::check()){
            return view('admin.class.teacher');
        }
  
        return redirect("admin-home");
    }

    public function classStudent()
    {
        if(Auth::check()){
            return view('admin.class.student');
        }
  
        return redirect("admin-home");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin-home');
    }
}