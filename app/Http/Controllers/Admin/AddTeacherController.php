<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AddTeacherController extends Controller
{
    public function dashboardAdmin()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
  
        return redirect("admin-home");
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
}
