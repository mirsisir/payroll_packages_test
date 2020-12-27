<?php

namespace kinetix\payroll\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

//    public function employees()
//    {
//        return $this->hasMany(Employee::class);
//    }

}
