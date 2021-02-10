<?php


use kinetix\payroll\Http\Livewire\Attendance\AttendanceComponent;
use kinetix\payroll\Http\Livewire\Salary\MakePaymentsComponent;
use kinetix\payroll\Http\Livewire\Salary\SalaryComponent;

use kinetix\payroll\Http\Controller\EmployeeController;
use kinetix\payroll\Http\Controller\HolidayController;
use kinetix\payroll\Http\Controller\LoanController;
use kinetix\payroll\Http\Controller\WorkingDaysController;
use kinetix\payroll\Http\Livewire\Employee\Edit;
use kinetix\payroll\Http\Controller\TestController;
use kinetix\payroll\Http\Livewire\LiveTestComponent;

//Route::get('content',function(){
//   return view('live::test');
//});
//

//Route::get('department1',function(){
//   return view('Payroll::index');
//});


//
//Route::get('/hello',[ TestController::class,'index'])->name('hello');
////
//Route::middleware(['web'])
//    ->group(function () {
//
//        Route::get('/live', LiveTestComponent::class)->name('sisir.test');
//
//        Route::get('/department', Crud::class)->name('Payroll.live');


Route::middleware(['web'])
    ->group(function () {



        Route::group(['prefix' => 'master', 'middleware' => ['auth', 'master']], function () {


            Route::get('/', [kinetix\payroll\Http\Controller\Master\MasterController::class, 'index'])->name('master.index');
            Route::resource('/clients', kinetix\payroll\Http\Controller\Master\ClientController::class);
            Route::resource('/license', kinetix\payroll\Http\Controller\Master\LicenseController::class);
        });


        Auth::routes();
        Route::get('/home', [kinetix\payroll\Http\Controller\HomeController::class, 'index'])->name('home');

        Route::middleware(['auth'])->group(function () {

            Route::get('/department', function () {
                return view('livewire.department.index');
            });

            Route::get('/set-working-days-livewire', function () {
                return view('livewire.working-day.index');
            });

            Route::view('/', 'Payroll::dashboard');
            Route::view('/dashboard', 'dashboard');

            Route::get('/set-working-days', [WorkingDaysController::class, 'index']);
            Route::post('/set-working-days', [WorkingDaysController::class, 'store']);

            Route::view('holidays', 'holidays/index');
            Route::view('holidays/create', 'holidays/create');
            Route::post('/holidays', [HolidayController::class, 'store']);
            Route::get('/holidays/{holiday}/edit', [HolidayController::class, 'edit']);
            Route::patch('/holidays/{holiday}', [HolidayController::class, 'update']);

            Route::view('/leave-categories', 'livewire.leave-category.index');

            Route::view('/employees', 'employees.index');
            Route::view('/employees/create', 'employees.create');
            Route::get('/employees/{employee}/edit', Edit::class);

            Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
            Route::get('/print_user/{employee}', [EmployeeController::class, 'print_user'])->name('print_user');


            Route::view('/applications', 'applications.index');
            Route::view('/applications/create', 'applications.create');


            Route::get('/salary_info', SalaryComponent::class)->name('salary_info');
            Route::get('/make_payments/{id}', MakePaymentsComponent::class)->name('make_payments');


            Route::get('/Attendance', AttendanceComponent::class)->name('attendance');


//Route::get('/Attendance_old',AttendanceComponent::class)->name('attendance');
//Route::get('/Attendance',\App\Http\Livewire\AttendanceTest::class)->name('attendance_test');

            Route::get('/loans', kinetix\payroll\Http\Livewire\Loan\Index::class);
            Route::get('/loans/create', kinetix\payroll\Http\Livewire\Loan\Create::class);
            Route::get('/loans/{loan}', [LoanController::class, 'show']);
            Route::delete('/loans/{loan}', [LoanController::class, 'destroy']);

            Route::get('/salary-sheet', kinetix\payroll\Http\Livewire\SalarySheetDetail::class);


            Route::get('/payslip/{e_id}/{month}', [EmployeeController::class, 'pay'])->name('payslip');

            Route::get('/payslip', [EmployeeController::class, 'payslip'])->name('payslip_generate');
            Route::post('/payslip_redirect', [EmployeeController::class, 'payslip_redirect'])->name('payslip_redirect');

//    Report ------------------------------------

            Route::get('/attendance_report', \kinetix\payroll\Http\Livewire\AttendanceReport::class)->name('attendance_report');
            Route::get('/primary_attendance_report', \kinetix\payroll\Http\Livewire\PrimaryAttendanceReport::class)->name('primary_attendance_report');
            Route::get('/details_attendance_report', \kinetix\payroll\Http\Livewire\AttendanceReportDetails::class)->name('details_attendance_report');


        });


    });
//

//
