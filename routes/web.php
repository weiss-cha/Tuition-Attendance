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

Route::get('class-teacher', [TeacherClassController::class, 'classTeacher'])->name('teacher.class'); 
Route::get('custom-class', [TeacherClassController::class, 'customClass'])->name('custom.class'); 

Route::get('class-student', [StudentClassController::class, 'classStudent'])->name('student.class'); 

Route::get('dashboard-teacher', [AttendanceController::class, 'dashboardTeacher'])->name('teacher.dashboard');