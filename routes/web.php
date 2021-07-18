<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Admin\AddTeacherController;
use App\Http\Controllers\Admin\TeacherClassController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Teacher\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('admin-home', [CustomAuthController::class, 'homeAdmin'])->name('admin.home');
Route::get('teacher-home', [CustomAuthController::class, 'homeTeacher'])->name('teacher.home');
Route::post('admin-login', [CustomAuthController::class, 'adminLogin'])->name('login.admin'); 
Route::post('teacher-login', [CustomAuthController::class, 'teacherLogin'])->name('login.teacher'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('dashboard-admin', [AddTeacherController::class, 'dashboardAdmin'])->name('admin.dashboard'); 
Route::post('custom-teacher', [AddTeacherController::class, 'customTeacher'])->name('teacher.custom');
Route::get('remove-teacher', [AddTeacherController::class, 'removeTeacher'])->name('teacher.remove');

Route::get('class-teacher', [TeacherClassController::class, 'classTeacher'])->name('teacher.class'); 
Route::get('custom-class', [TeacherClassController::class, 'customClass'])->name('custom.class'); 
Route::get('remove-class', [TeacherClassController::class, 'removeClass'])->name('remove.class'); 

Route::get('class-student', [StudentClassController::class, 'classStudent'])->name('student.class'); 
Route::get('custom-student', [StudentClassController::class, 'customStudent'])->name('custom.student'); 
Route::get('remove-student', [StudentClassController::class, 'removeStudent'])->name('remove.student'); 

Route::get('custom-attendance', [AttendanceController::class, 'customAttendance'])->name('custom.attendance');
Route::get('take-attendance', [AttendanceController::class, 'takeAttendance'])->name('take.attendance');
Route::get('date-attendance', [AttendanceController::class, 'dateAttendance'])->name('date.attendance');
Route::get('check-attendance', [AttendanceController::class, 'checkAttendance'])->name('check.attendance');