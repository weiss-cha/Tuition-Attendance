<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard-admin', [CustomAuthController::class, 'dashboardAdmin'])->name('admin.dashboard'); 
Route::get('admin-home', [CustomAuthController::class, 'homeAdmin'])->name('admin.home');
Route::get('teacher-home', [CustomAuthController::class, 'homeTeacher'])->name('teacher.home');
Route::post('admin-login', [CustomAuthController::class, 'adminLogin'])->name('login.admin'); 
Route::post('teacher-login', [CustomAuthController::class, 'teacherLogin'])->name('login.teacher'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('custom-teacher', [CustomAuthController::class, 'customTeacher'])->name('teacher.custom');
Route::get('class-teacher', [CustomAuthController::class, 'classTeacher'])->name('teacher.class'); 
Route::get('class-student', [CustomAuthController::class, 'classStudent'])->name('student.class'); 
Route::get('dashboard-teacher', [CustomAuthController::class, 'dashboardTeacher'])->name('teacher.dashboard');