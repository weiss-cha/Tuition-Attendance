<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class StudentClassController extends Controller
{
    //Redirect to 'Register Student' Page if Logged in
    public function classStudent()
    {
        if(Auth::check()){
            return view('admin.class.student');
        }
  
        return redirect("admin-home");
    }

    //After Clicking 'Register' Button
    public function customStudent(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'student_name' => 'required',
        ]);
           
        //Obtain Input
        $class_name = $request->class_name;
        $student_name = $request->student_name;

        //Call Function
        $check = $this->addStudent($class_name, $student_name);
         
        return redirect("class-student")->with('success', 'Student Registered');  
    }

    //Insert Student Name to Class Table (Assign Student to Class)
    public function addStudent($class_name, $student_name)
    {
        DB::table("{$class_name}")  ->  insert([
            'student_name' =>  "{$student_name}",      
        ]);
    }

    //After Clicking 'Remove' Button
    public function removeStudent(Request $request)
    {
        $request->validate([
            'class_name_2' => 'required',
            'student_name_2' => 'required',
        ]);
           
        //Obtain Input
        $class_name_2 = $request->class_name_2;
        $student_name_2 = $request->student_name_2;

        //Call Function
        $check = $this->deleteStudent($class_name_2, $student_name_2);
    
        return redirect("class-student")->with('success', 'Student Removed');
    }

    //Delete Student from Class Table
    public function deleteStudent($class_name_2, $student_name_2)
    {
        DB::table("{$class_name_2}")  ->  where('student_name', "{$student_name_2}") -> delete();
    }
}
