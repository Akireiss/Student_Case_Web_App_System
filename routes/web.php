<?php

use App\Http\Livewire\Admin\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\StudentsProfile;
use App\Http\Livewire\Adviser\StudentProfile;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OffensesController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Adviser\DashboardController;
use App\Http\Controllers\Adviser\StudentReportController;
use App\Http\Controllers\Adviser\AdvisorDashboardController;

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



// Group for admin access
// Group for admin access
Route::middleware(['auth', 'role'])->group(function () {

    // Admin Access
    Route::middleware(['can:admin-access'])->group(function () {

        Route::prefix('admin')->group(function () {
            // Students Profile Area
            Route::get('student-profile', function () {
                return view('admin.student-profile.index');
            });
            Route::get('student-profile/add', StudentsProfile::class);
        });

        Route::prefix('admin/settings')->group(function () {

            // Settings Area - Offenses
            Route::get('offenses', [OffensesController::class, 'index']);
            Route::get('offenses/create', [OffensesController::class, 'create']);
            Route::post('offenses/store', [OffensesController::class, 'store']);
            Route::get('offenses/{offense}/edit', [OffensesController::class, 'edit'])->name('offenses.edit');
            Route::put('offenses/{id}', [OffensesController::class, 'update'])->name('admin.settings.offenses.update');

            // Employees
            Route::get('teachers', [EmployeeController::class, 'index']);
            // Route::get('teachers/create', [EmployeeController::class, 'create']);
            // Route::post('employees/store', [EmployeeController::class, 'store']);
            Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');

            // Classrooms
            Route::get('classrooms', [ClassroomController::class, 'index']);
            Route::get('classroom/create', [ClassroomController::class, 'create']);
            Route::get('classroom/{id}', [ClassroomController::class, 'show']);
            Route::post('classroom/store', [ClassroomController::class, 'store'])->name('admin.classroom.store');

            Route::get('classrooms/{id}/edit', [ClassroomController::class, 'edit']);
            Route::put('classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');

            // Temporary as the backend is still in development
            Route::get('audit-trail', function () {
                return view('admin.settings.audit-trail.index');
            });

            // Students Area
            Route::get('students', [StudentController::class, 'index']);
            Route::get('students/create', [StudentController::class, 'create']);
            Route::post('students/store', [StudentController::class, 'store']);
        });
    });

    // Adviser | Staff Area
    Route::middleware(['can:adviser-access'])->group(function () {
        Route::prefix('adviser')->group(function () {
            Route::get('dashboard', [AdvisorDashboardController::class, 'index']);
            Route::get('report/student', [StudentReportController::class, 'index']);
            Route::post('report/student', [StudentReportController::class, 'store']);

            Route::get('student/anecdotal/{id}', [StudentController::class, 'show']);

            // Livewire
            Route::get('students-profile', StudentProfile::class);
        });
    });
});


//Still neeed fix for this area
//Route::get('dashboard', function () {
//    return view('admin.dashboard.dashboard');
//});

Route::get('dashboard', \App\Http\Livewire\Admin\Dashboard::class);






Route::get('admin/reports', [ReportController::class, 'index']);
Route::get('admin/reports/add', [ReportController::class, 'create']);


Route::get('admin/update-acc', [UserController::class, 'update_acc']);
Route::get('admin/add-acc', [UserController::class, 'index']);


Route::get('test', function () {
    return view('test');
});


