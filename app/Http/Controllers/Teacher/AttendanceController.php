<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DB;

class AttendanceController extends Controller
{

    public function customAttendance(Request $request)
    {
        $request->validate([
            'class' => 'required',
        ]);

        $class = $request->class;
        $date = date("Y-m-d");
    
        if (Schema::hasColumn("{$class}", "{$date}")){
            return view('teacher.attendance.date')->with('class', $class);
        }

        $attendance = DB::table("{$class}")->get();
        $attendance_array = json_decode(json_encode($attendance), true);
        return view('teacher.attendance.take', compact('attendance_array'))->with('class', $class);
    }

    public function takeAttendance(Request $request)
    {
        $student_name = $request->student_name;
        $class = $request->class;
        $date = date("Y-m-d");


        if (!Schema::hasColumn("{$class}", "{$date}")){

            Schema::table("{$class}", function (Blueprint $table) use($class, $date){
                $table->boolean("{$date}");
            });
            
            foreach($student_name as $student_name_2){
                DB::table("{$class}") -> where('student_name', "{$student_name_2}") -> update([
                    "{$date}" => true,
                ]);
            }

            return view('teacher.attendance.success');
        }
    
        return view('teacher.attendance.done');
    }

    public function dateAttendance(Request $request)
    {
        $class = $request->class;
        return view('teacher.attendance.date')->with('class', $class);
    }

    public function checkAttendance(Request $request)
    {   
        $class = $request->class;
        $date = $request->date;
        
        if (Schema::hasColumn("{$class}", "{$date}")){
            $attendance = DB::table("{$class}")->get();
            $attendance_array = json_decode(json_encode($attendance), true);
            return view('teacher.attendance.check', compact('attendance_array'))->with('date', $date);
        }

        return view('teacher.attendance.null');
    }
}
