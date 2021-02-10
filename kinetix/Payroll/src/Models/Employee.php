<?php

namespace kinetix\payroll\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function salaryInfo()
    {
        return $this->hasOne(SalaryInfo::class);
    }

    public function attendanceRecord()
    {
        return $this->hasOne(Attendance::class);
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
