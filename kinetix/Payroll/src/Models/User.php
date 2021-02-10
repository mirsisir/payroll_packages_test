<?php

namespace kinetix\payroll\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function workingdays()
    {
        return $this->hasMany(WorkingDay::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function leave_categories()
    {
        return $this->hasMany(LeaveCategory::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function salary_sheets()
    {
        return $this->hasMany(SalarySheet::class);
    }
}
