<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Hash;
use DB;

class AddTeacherController extends Controller
{
    public function dashboardAdmin()
    {
        if(Auth::check()){
            $userList = User::select('name')->where('name', '!=', 'admin')->get();
            return view('admin.dashboard', compact('userList'));
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
        $check = $this->addTeacherClass($teacher);
         
        return redirect("dashboard-admin")->with('success', 'Teacher Added');       
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

    public function addTeacherClass(array $teacher)
    {
        return Schema::create($teacher['name'], function (Blueprint $table) use($teacher) {
            $table->id();
            $table->string('class_name');
        });
    }

    public function removeTeacher(Request $request)
    {
        $request->validate([
            'teacher_2' => 'required',
        ]);
           
        $teacher_2 = $request->teacher_2;
        $check = $this->deleteTeacher($teacher_2);
        $check = $this->deleteTeacherClass($teacher_2);
    
        return redirect("dashboard-admin")->with('success', 'Teacher Removed');
    }

    public function deleteTeacher($teacher_2)
    {
        DB::table('users')->where('name', "{$teacher_2}")->delete();
    }

    public function deleteTeacherClass($teacher_2)
    {
        Schema::dropIfExists("{$teacher_2}");
    }
}
