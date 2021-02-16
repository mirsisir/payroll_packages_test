<?php

namespace kinetix\payroll;




use Illuminate\Support\ServiceProvider;
use kinetix\payroll\Http\Livewire\Department\Crud;


use kinetix\payroll\Http\Livewire\Employee\Create;
use kinetix\payroll\Http\Livewire\Salary\MakePaymentsComponent;
use kinetix\payroll\Http\Livewire\Salary\SalaryComponent;
use kinetix\payroll\Models\Application;


use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Designation;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Holiday;
use kinetix\payroll\Models\LeaveCategory;
use kinetix\payroll\Models\Loan;
use kinetix\payroll\Models\SalaryInfo;
use kinetix\payroll\Models\SalarySheet;
use kinetix\payroll\Models\WorkingDay;
use Livewire\Livewire;
use kinetix\payroll\Http\Livewire\LiveTestComponent;

class HRMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
//        Livewire::component('acc::voucher-entry-component', VoucherEntryComponent::class);


        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'Payroll');


        Livewire::component('sisir::live-test-component', LiveTestComponent::class);

        Livewire::component('Payroll::crud', Crud::class);

        Livewire::component('Payroll::livewire.employee.create', Create::class);

        Livewire::component('Payroll::livewire.attendance.attendance-component', \kinetix\payroll\Http\Livewire\Attendance\AttendanceComponent::class);

        Livewire::component('Payroll::livewire.primary-attendance-report', \kinetix\payroll\Http\Livewire\PrimaryAttendanceReport::class);
        Livewire::component('Payroll::livewire.attendance-report-details', \kinetix\payroll\Http\Livewire\AttendanceReportDetails::class);

        Livewire::component('Payroll::livewire.application.create', \kinetix\payroll\Http\Livewire\Application\Create::class);
        Livewire::component('Payroll::livewire.loan.create', \kinetix\payroll\Http\Livewire\Loan\Create::class);


        Livewire::component('Payroll::livewire.salary.salary-component', SalaryComponent::class);
        Livewire::component('Payroll::livewire.salary.make-payments-component', MakePaymentsComponent::class);






//        settings
        Livewire::component('Payroll::livewire.holiday.crud', \kinetix\payroll\Http\Livewire\Holiday\Crud::class);
        Livewire::component('Payroll::livewire.leave-category.crud', \kinetix\payroll\Http\Livewire\LeaveCategory\Crud::class);






//        Livewire::component('Payroll::livewire.application.create', Create::class);

//        Livewire::component('Payroll::\livewire.employee.create',\kinetix\payroll\Http\Livewire\Employee\Create::class);


        \kinetix\payroll\Models\Attendance::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });


        Department::creating(function($model){
            $model->client_id = auth()->user()->client_id;
            $model->user_id = auth()->user()->id;
        });
        Designation::creating(function($model){
            $model->client_id = auth()->user()->client_id;
            $model->user_id = auth()->user()->id;
        });

        WorkingDay::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        Holiday::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        LeaveCategory::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        Employee::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        SalaryInfo::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        SalarySheet::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        Application::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });

        Loan::creating(function ($model){
            $model->user_id = auth()->user()->id;
            $model->client_id = auth()->user()->client_id;
        });



//        publish

        $this->publishes([
            __DIR__.'/views/layouts/app-hrm.blade.php' => config_path('/views/layouts/app-hrm.blade.php'),
        ], 'views');



    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
