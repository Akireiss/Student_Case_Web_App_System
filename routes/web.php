<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OffensesController;
use App\Http\Controllers\Admin\ClassroomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::prefix('admin/settings')->group(function () {
    //offenses
    Route::get('offenses', [OffensesController::class, 'index']);
    Route::get('offenses/create', [OffensesController::class, 'create']);
    Route::post('offenses/store', [OffensesController::class, 'store']);
    Route::get('offenses/{offense}/edit', [OffensesController::class, 'edit'])->name('offenses.edit');
    Route::put('offenses/{id}', [OffensesController::class, 'update'])->name('admin.settings.offenses.update');

    //employeee
    Route::get('teachers', [EmployeeController::class, 'index']);
    Route::get('teacher/create', [EmployeeController::class, 'create']);
    Route::post('employee/store', [EmployeeController::class, 'store']);



    //classrooms
    Route::get('classrooms', [ClassroomController::class, 'index']);
    Route::get('classroom/create', [ClassroomController::class, 'create']);
    Route::post('classroom/store', [ClassroomController::class, 'store']);
    Route::get('classrooms/{id}/edit', [ClassroomController::class, 'edit']);
    Route::put('classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');


    //Employee
    Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');



    Route::get('admin/student-profile', function () { return view('admin.student-profile.index');});
    // Temporary as the backend is still in development
    Route::get('students', function () { return view('admin.settings.students.index');});
    Route::get('audit-trail', function () { return view('admin.settings.audit-trail.index');});


});


//Still neeed fix for this area


Route::prefix('admin')->middleware(['auth'])->group(function (){
    Route::get('dashboard', function () {
        return view('admin.dashboard.dashboard');
    });

    });



    Route::get('admin/reports',[ReportController::class, 'index']);
    Route::get('admin/update-acc',[UserController::class, 'update_acc']);
    Route::get('admin/add-acc',[UserController::class, 'index']);
