<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    public function classStudent()
    {
        if(Auth::check()){
            return view('admin.class.student');
        }
  
        return redirect("admin-home");
    }
}
