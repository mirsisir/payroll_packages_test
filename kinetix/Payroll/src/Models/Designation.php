<?php

namespace kinetix\payroll\Models;

use kinetix\payroll\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

//    public function employees()
//    {
//        return $this->hasMany(Employee::class);
//    }
}
