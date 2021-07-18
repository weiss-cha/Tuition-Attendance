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
    //Redirect to 'Add Teacher' Page if Logged in
    public function dashboardAdmin()
    {   
        if(Auth::check()){
            //Obtain Dropdown List Option (Teacher List)
            $userList = User::select('name')->where('name', '!=', 'admin')->get();
            return view('admin.dashboard', compact('userList'));
        }
  
        return redirect("admin-home");
    }

    //After Clicking 'Add' Button
    public function customTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        
        //Obtain Input
        $teacher = $request->all();

        //Call Functions
        $check = $this->addTeacher($teacher);
        $check = $this->addTeacherClass($teacher);
         
        return redirect("dashboard-admin")->with('success', 'Teacher Added');       
    }

    //Insert Data into User Table (For Login Purpose)
    public function addTeacher(array $teacher)
    {
        return User::create([
            'name' => $teacher['name'],
            'email' => $teacher['email'],
            'password' => Hash::make($teacher['password']),
            'role_id' => 2  //role_id: Admin = 1, Teacher = 2 (Avoid Tearcher from Accessing Admin Page)
        ]);
    }

    //Create Teacher-Class Relation Table
    public function addTeacherClass(array $teacher)
    {
        return Schema::create($teacher['name'], function (Blueprint $table) use($teacher) {
            $table->id();
            $table->string('class_name');
        });
    }

    //After Clicking 'Remove' Button
    public function removeTeacher(Request $request)
    {
        $request->validate([
            'teacher_2' => 'required',
        ]);
         
        //Obtain Input
        $teacher_2 = $request->teacher_2;

        //Call Functions
        $check = $this->deleteTeacher($teacher_2);
        $check = $this->deleteTeacherClass($teacher_2);
    
        return redirect("dashboard-admin")->with('success', 'Teacher Removed');
    }

    //Delete Selected Row(Teacher) from Table
    public function deleteTeacher($teacher_2)
    {
        DB::table('users')->where('name', "{$teacher_2}")->delete();
    }

    //Drop Selected Teacher-Class Relation Table
    public function deleteTeacherClass($teacher_2)
    {
        Schema::dropIfExists("{$teacher_2}");
    }
}
