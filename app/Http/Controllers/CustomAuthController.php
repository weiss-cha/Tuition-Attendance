<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');

        }
  
        return redirect("login");
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login");
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
         
        return redirect("dashboard");        
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
            return view('class.teacher');
        }
  
        return redirect("login");
    }

    public function classStudent()
    {
        if(Auth::check()){
            return view('class.student');
        }
  
        return redirect("login");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}