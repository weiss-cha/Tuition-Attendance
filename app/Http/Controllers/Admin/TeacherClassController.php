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
    public function classTeacher()
    {
        if(Auth::check()){
            $userList = User::select('name')->where('name', '!=', 'admin')->get();
            return view('admin.class.teacher', compact('userList'));
        }
  
        return redirect("admin-home");
    }

    public function customClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'teacher' => 'required', 
        ]);
           
        $class_name = $request->class_name;
        $teacher = $request->teacher;
        $check = $this->createClass($class_name);
        $check = $this->assignClass($class_name, $teacher);

         
        return redirect("class-teacher")->with('success', 'Class Created');
    }

    public function createClass($class_name)
    {
        Schema::create($class_name, function (Blueprint $table) use($class_name) {
            $table->id();
            $table->string('student_name');
        });
    }

    public function assignClass($class_name, $teacher)
    {
        DB::table("{$teacher}")  ->  insert([
            'class_name' =>  "{$class_name}",      
        ]);
    }

    public function removeClass(Request $request)
    {
        $request->validate([
            'class_name_2' => 'required',
            'teacher_2' => 'required',
        ]);
           
        $class_name_2 = $request->class_name_2;
        $teacher_2 = $request->teacher_2;
        $check = $this->deleteClass($class_name_2, $teacher_2);
    
        return redirect("class-teacher")->with('success', 'Class Removed');
    }

    public function deleteClass($class_name_2, $teacher_2)
    {
        Schema::dropIfExists("{$class_name_2}");

        DB::table("{$teacher_2}")->where('class_name', "{$class_name_2}")->delete();
    }
}
