<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function classTeacher()
    {
        if(Auth::check()){
            return view('admin.class.teacher');
        }
  
        return redirect("admin-home");
    }
}
