<?php

use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\YearlyReportController;
use App\Http\Controllers\Adviser\RefferController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\RestoreController;
use App\Http\Controllers\Student\AuthController;
use App\Http\Livewire\Admin\Classroom\Classroom;
use App\Http\Livewire\Admin\Classroom\ClassroomUpdate;
use App\Http\Livewire\Admin\User;
use App\Http\Livewire\Admin\AddUser;
use App\Http\Livewire\Admin\Student;
use App\Http\Livewire\Admin\Teacher;
use App\Http\Livewire\Admin\User\UserUpdate;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Student\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Adviser\Dashboard;
use App\Http\Livewire\Admin\YearlyReport;
use App\Http\Livewire\Student\StudentForm;
use App\Http\Livewire\Adviser\ReferStudent;
use App\Http\Livewire\Student\ReportUpdate;
use App\Http\Controllers\ReminderController;
use App\Http\Livewire\Adviser\ReportHistory;
use App\Http\Livewire\Adviser\StudentProfile;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Livewire\Admin\Student\EditStudent;
use App\Http\Livewire\Admin\Teacher\EditTeacher;
use App\Http\Livewire\Admin\Offenses\EditOffense;
use App\Http\Controllers\Admin\OffensesController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Dashboard\ResolvedCases;
use App\Http\Controllers\Student\StudentDataController;
use App\Http\Controllers\Admin\StudentProfileController;
use App\Http\Livewire\Student\Profile\StudentProfileUpdate;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role'])->group(function () {

    // Admin Access
    Route::middleware(['can:admin-access'])->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index']);
            //Reports

            Route::get('reports', [ReportController::class, 'index']);
            Route::get('reports/create', Report::class);

            //Recent cases from the scheduled resolved cases
            Route::get('student/recent-cases/{id}', [ReportController::class, 'recentCases']);




            Route::get('report/add', [ReportController::class, 'create']);
            Route::get('reports/{anecdotal}/view', [ReportController::class, 'view'])
                ->name('anecdotal.view');
            Route::get('reports/{anecdotal}/edit', ReportUpdate::class)->name('anecdotal.edit');


            //User Manage
            Route::get('update-acc', User::class);
            Route::get('add-acc', AddUser::class)->name('users.add');
            Route::get('user/accounts', function () {
                return view('admin.user.index');
            });
            //User Accouts Update
            Route::get('user/accounts/update/{userId}', UserUpdate::class)->name('user.edit');


            // Students Profile Area
            Route::get('student-profile', [StudentProfileController::class, 'index']);

            //Livewire Component
            Route::get('student-profile/{profile}/edit', StudentProfileUpdate::class)
                ->name('admin.profile.edit');


            Route::get('student-profile/{profile}/view', [StudentProfileController::class, 'show'])
                ->name('admin.profile.show');

            Route::get('student-profile/add', \App\Http\Livewire\Student\StudentProfile::class);
        });

        Route::prefix('admin/settings')->group(function () {
            // Settings Area - Offenses
            Route::get('offenses', [OffensesController::class, 'index']);
            Route::get('offenses/create', [OffensesController::class, 'create']);

            Route::post('offenses/store', [OffensesController::class, 'store']);
            Route::get('offenses/store/{offense}/view', [OffensesController::class, 'view'])
                ->name('admin.offense.view');
            //*Update
            Route::get('student-profile/{offense}/update', EditOffense::class)
                ->name('admin.offense.edit');

            // Employees
            Route::get('teachers', Teacher::class);
            Route::get('teachers/update/{employee}', EditTeacher::class)
                ->name('teacher.edit');
            Route::get('teachers/view/{employee}', [EditTeacher::class, 'view'])
                ->name('teacher.view');
            //Classroom

            Route::get('classrooms', Classroom::class);
            Route::get('classrooms/{classroom}/view', [Classroom::class, 'view'])->name('classroom.view');

            //Classroom Student Update
            Route::get('classrooms/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classroom.edit');
            // Route::resource('classrooms', ClassroomController::class);
            Route::put('classrooms/students/update/{classroom}', [ClassroomController::class, 'updateStudents'])
            ->name('classrooms.students.update');
            //Classroom Update
            Route::get('classrooms/{classroom}/update', [ClassroomController::class, 'update'])->name('classrooms.update');


            // Report History
            Route::get('report/history', function () {
                return view('staff.report-history.index');
            });
            Route::get('report/history/{report}/view', [ReportHistory::class, 'view'])->name('admin.report.view');
            Route::get('report/history/{report}/edit', ReportHistory::class)->name('admin.report.edit');


            Route::get('audit-trail', function () {
                return view('admin.settings.audit-trail.index');
            });
            Route::get('audit-trail/view/{activity}', [HelpController::class, 'show'])->name('activity.view');

            //Generate Report
            Route::get('generate-report', [PdfController::class, 'generateReport']);



            // Students Area
            Route::get('students', Student::class);
            Route::get('student/update/{student}', EditStudent::class)->name('student.edit');
            Route::get('student/view/{student}', [EditStudent::class, 'view'])
                ->name('student.view');

            //Generate Report
            Route::get(
                'yearly-report/view/{yearlyReport}',
                [YearlyReportController::class, 'index']
            )
                ->name('yearly-report.view');


            //Yearly Report
            Route::get('yearly-report', YearlyReport::class);
        });
    });

    // Adviser | Staff Area
    Route::middleware(['can:adviser-access'])->group(function () {
        Route::prefix('adviser')->group(function () {
            //*Dashboard
            Route::get('dashboard', Dashboard::class);
            //*Livewire Report Student
            Route::get('report/student', \App\Http\Livewire\Adviser\Report::class);
            //*Student Profile//livewire
            Route::get('students-profile', StudentProfile::class);
            //*Add
            Route::get('student-profile/add', \App\Http\Livewire\Student\StudentProfile::class);
            //*Edit
            Route::get('student-profile/{profile}/edit', StudentProfileUpdate::class)
                ->name('adviser.profile.edit');

            Route::get('student-profile/{profile}/view', [StudentProfile::class, 'show'])->name('adviser.profile.view');
            //*History
            Route::get('report/history', function () {
                return view('staff.report-history.index');
            });
            Route::get('report/history/{report}/view', [ReportHistory::class, 'view'])->name('report.view');
            Route::get('report/history/{report}/edit', ReportHistory::class)->name('report.edit');
            //*Students


            Route::get('students', function () {
                return view('staff.students.index');
            });

            Route::get('students/{student}/edit', ReferStudent::class)->name('adviser.students.edit');
            Route::get('students/{student}/view', [ReferStudent::class, 'view'])->name('adviser.students.view');

            Route::get('classroom/{classroom}', [RefferController::class, 'index']);

            Route::put('/students/{classroom}', [RefferController::class, 'update'])->name('studentsClassroom.update');


            //HS Issue


            //*Account Management
            Route::get('update-acc', User::class);
            Route::get('add-acc', AddUser::class);

        });
    });

    Route::middleware(['can:user-access'])->group(function () {
        Route::get('report/student', Report::class);
        Route::get('report/history', function () {
            return view('staff.report-history.index');
        });
        Route::get('report/history/{report}/view', [ReportHistory::class, 'view'])->name('user.report.view');
        Route::get('report/history/{report}/edit', ReportHistory::class)->name('user.report.edit');

    });
});

//*End-points
Route::get('/get-chart-data', [HelpController::class, 'getChartData']);

Route::get('/admin/get-case-counts', [DashboardController::class, 'getCaseCounts']);
Route::get('/get-offense-counts', [DashboardController::class, 'getOffenseCounts']);
Route::get('/get-dashboard-data', [DashboardController::class, 'getDashboardData']);
Route::get('/get-weekly-report-count', [DashboardController::class, 'getWeeklyReportCount']);
Route::get('/get-monthly-report-count', [DashboardController::class, 'getMonthlyReportCount']);
//*resolved cases end points
Route::get('/get-resolved-cases', [DashboardController::class, 'getResolvedCases'])->name('get.resolved.cases');
//*Actions Taken (Successfull)
Route::get('/get-successful-actions', [DashboardController::class, 'getSuccessfulActions']);
//*Onoging Cases (Notification)
Route::get('/get-ongoing-actions',[DashboardController::class, 'getOngoingCases']
);
//Delayed notif endpoints
Route::post('/mark-notification-read/{notification}', [DashboardController::class, 'markAsRead'])->name('mark-notification-read');

//ResolvedCase
Route::get('admin/resolved-cases', ResolvedCases::class);

//Test Schedule
Route::get('/reminders/create', [ReminderController::class, 'create'])->name('reminders.create');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');

//Help Area
Route::get('help', [HelpController::class, 'index']);
Route::resource('students', ReportHistory::class);

//Pdf Here
//For View
Route::get('generate-pdf/{id}', [PdfController::class, 'generatePdf'])->name('generate-pdf');
//For Table
Route::get('generate-pdf/{profile}', [PdfController::class, 'generatePdf'])->name('admin.generate-pdf');
Route::get('test/pdf/{id}', [PdfController::class, 'testPdf']);



//Rejected functions During Pre Def//Uncomment if you want to use
//*Student Area
//Student Authentication
//Route::get('student/lrn/{profileId}', [AuthController::class, 'login'])->name('student.login');
//Login here
//Route::post('student/login/{profileId}', [AuthController::class, 'auth'])->name('student.auth');
//students here
//Cases
//Route::get('student/view/cases/{studentID}', [StudentDataController::class, 'viewCases']);

//*Student Profile Data
// Route::get('student/form', StudentForm::class);
//Route::get('student/form/{id}/edit', StudentFormUpdate::class)->name('profile.show');
// Route::get('student/profile/create', \App\Http\Livewire\Student\StudentProfile::class);

// Route::get('student/profile/data/{form_id}', [StudentDataController::class, 'index'])
// ->name('student.profile.data')->middleware('profileAuth');

// Route::get('student/profile/data/{form_id}/view',
//  [StudentDataController::class, 'view']);
// //*student form update
// Route::get('student-profile/data/{profile}/edit', StudentProfileUpdate::class);


Route::get('/backup', [BackupController::class, 'index']);
Route::post('backup/execute', [BackupController::class, 'backup'])->name('manual.backup');

// Route::get('/backup/db', [BackupController::class, 'backup'])->name('backup');
Route::get('/download-backup', [BackupController::class, 'downloadDatabase'])->name('backup.download');

Route::get('/restore', [RestoreController::class, 'index']);
Route::get('/restore', [RestoreController::class, 'store']);


