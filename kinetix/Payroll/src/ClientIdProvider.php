<?php

namespace App\Providers;

use kinetix\payroll\Models\Application;
use kinetix\payroll\Models\Attendance;
use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Designation;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Holiday;
use kinetix\payroll\Models\LeaveCategory;
use kinetix\payroll\Models\Loan;
use kinetix\payroll\Models\SalaryInfo;
use kinetix\payroll\Models\SalarySheet;
use kinetix\payroll\Models\WorkingDay;
use Illuminate\Support\ServiceProvider;

class ClientIdProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Attendance::creating(function ($model){
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


    }
}
