<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function dashboardTeacher()
    {
        if(Auth::check()){
            return view('teacher.dashboard');
        }
  
        return redirect("teacher-home");
    }
}
