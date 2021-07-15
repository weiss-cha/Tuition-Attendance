<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherClassController extends Controller
{
    public function classTeacher()
    {
        if(Auth::check()){
            return view('admin.class.teacher');
        }
  
        return redirect("admin-home");
    }

    public function customClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
        ]);
           
        $class_name = $request->all();
        $check = $this->createClass($class_name);
         
        return redirect("class-teacher")->with('success', 'Class Created');
    }

    public function createClass(array $class_name)
    {
        Schema::create($class_name['class_name'], function (Blueprint $table) use($class_name) {
            $table->id();
            $table->string('student_name');
        });
    }
}
