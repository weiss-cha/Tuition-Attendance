<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use DB;

class TeacherClassController extends Controller
{
    //Redirect to 'Create Class' Page if Logged in
    public function classTeacher()
    {
        if(Auth::check()){
            //Obtain Dropdown List Option (Teacher List)
            $userList = User::select('name')->where('name', '!=', 'admin')->get();
            return view('admin.class.teacher', compact('userList'));
        }
  
        return redirect("admin-home");
    }

    //After Clicking 'Create' Button
    public function customClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'teacher' => 'required', 
        ]);
        
        //Obtain Input
        $class_name = $request->class_name;
        $teacher = $request->teacher;

        //Call Functions
        $check = $this->createClass($class_name);
        $check = $this->assignClass($class_name, $teacher);
 
        return redirect("class-teacher")->with('success', 'Class Created');
    }

    //Create Class Table (Create Class for Teacher)
    public function createClass($class_name)
    {
        Schema::create($class_name, function (Blueprint $table) use($class_name) {
            $table->id();
            $table->string('student_name');
        });
    }

    //Insert Class Name to Teacher-Class Relation Table (Assign Class to Teacher)
    public function assignClass($class_name, $teacher)
    {
        DB::table("{$teacher}")  ->  insert([
            'class_name' =>  "{$class_name}",      
        ]);
    }

    //After Clicking 'Remove' Button
    public function removeClass(Request $request)
    {
        $request->validate([
            'class_name_2' => 'required',
            'teacher_2' => 'required',
        ]);
           
        //Obtain Input
        $class_name_2 = $request->class_name_2;
        $teacher_2 = $request->teacher_2;

        //Call Function
        $check = $this->deleteClass($class_name_2, $teacher_2);
    
        return redirect("class-teacher")->with('success', 'Class Removed');
    }

    public function deleteClass($class_name_2, $teacher_2)
    {
        //Drop Class Table if Exists
        Schema::dropIfExists("{$class_name_2}");

        //Delete Class from Teacher-Class Relation Table
        DB::table("{$teacher_2}")->where('class_name', "{$class_name_2}")->delete();
    }
}
