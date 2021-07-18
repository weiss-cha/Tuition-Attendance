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
    //'Attendance' Page
    
    //After Clicking 'Submit' Button (Choose Assigned Class from Dropdown List)
    public function customAttendance(Request $request)
    {
        $request->validate([
            'class' => 'required',
        ]);

        //Obtain Input
        $class = $request->class;

        //Obtain Today's Date
        $date = date("Y-m-d");

        //If Already Taken Attendance -> Redirect to 'Check Record' Page
        if (Schema::hasColumn("{$class}", "{$date}")){
            return view('teacher.attendance.date')->with('class', $class);
        }

        //If Haven't Take Attendance -> Redirect to 'Take Attendance' Page
        //Obtain Data From Selected Class Table
        $attendance = DB::table("{$class}")->get();

        //Convert Data to Array (To Show Class Table on Website)
        $attendance_array = json_decode(json_encode($attendance), true);
        return view('teacher.attendance.take', compact('attendance_array'))->with('class', $class);
    }

    //'Take Attendance' Page
    public function takeAttendance(Request $request)
    {
        //Obtain Input from Checkbox
        $student_name = $request->student_name;

        //Obtain Hidden Input
        $class = $request->class;

        //Obtain Today's Date
        $date = date("Y-m-d");

        //After Clicking 'Take Attendance' Button
        //If Haven't Take Attendance
        if (!Schema::hasColumn("{$class}", "{$date}")){

            //Add New Column to Class Table (Using Today's Date as Column Name)
            Schema::table("{$class}", function (Blueprint $table) use($class, $date){
                $table->boolean("{$date}");
            });
            
            //Take Attendance Based on Checkbox Ticked
            foreach($student_name as $student_name_2){

                //Present = true, Absent = false (Boolean)
                DB::table("{$class}") -> where('student_name', "{$student_name_2}") -> update([
                    "{$date}" => true,
                ]);
            }

            //Show 'Success' Message After Taking Attendance
            return view('teacher.attendance.success');
        }
    
        //If Already Taken Attendance -> Show 'Attendance Already Taken' Message
        return view('teacher.attendance.done');
    }

    //'Check Record' Page
    //Two Way to Access: 1. Clicking 'Check Record' Button on 'Take Attendance' Page
    //                   2. Auto Redirect If Already Taken Attendance
    public function dateAttendance(Request $request)
    {
        //Obtain Hidden Input
        $class = $request->class;

        return view('teacher.attendance.date')->with('class', $class);
    }

    //After Clicking 'Submit' Button (Choose Date from Calendar)
    public function checkAttendance(Request $request)
    {   
        //Obtain Hidden Input
        $class = $request->class;

        //Obtain Input (From Calendar) **NOT Today's Date
        $date = $request->date;
        
        //If Selected Date Has Record -> Show Class Table on Website (For Checking)
        //Present = 1, Absent = 0
        if (Schema::hasColumn("{$class}", "{$date}")){
            $attendance = DB::table("{$class}")->get();
            $attendance_array = json_decode(json_encode($attendance), true);
            return view('teacher.attendance.check', compact('attendance_array'))->with('date', $date);
        }

        //If Selected Date Has NO Record -> Show 'No Record Available' Message
        return view('teacher.attendance.null');
    }
}
