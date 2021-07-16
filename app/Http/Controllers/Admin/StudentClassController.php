<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class StudentClassController extends Controller
{
    public function classStudent()
    {
        if(Auth::check()){
            return view('admin.class.student');
        }
  
        return redirect("admin-home");
    }

    public function customStudent(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'student_name' => 'required',
        ]);
           
        $class_name = $request->class_name;
        $student_name = $request->student_name;
        $check = $this->addStudent($class_name, $student_name);
         
        return redirect("class-student")->with('success', 'Student Registered');  
    }

    public function addStudent($class_name, $student_name)
    {
        DB::table("{$class_name}")  ->  insert([
            'student_name' =>  "{$student_name}",      
        ]);
    }

    public function removeStudent(Request $request)
    {
        $request->validate([
            'class_name_2' => 'required',
            'student_name_2' => 'required',
        ]);
           
        $class_name_2 = $request->class_name_2;
        $student_name_2 = $request->student_name_2;
        $check = $this->deleteStudent($class_name_2, $student_name_2);
    
        return redirect("class-student")->with('success', 'Student Removed');
    }

    public function deleteStudent($class_name_2, $student_name_2)
    {
        DB::table("{$class_name_2}")  ->  where('student_name', "{$student_name_2}") -> delete();
    }
}
