<?php

namespace kinetix\payroll\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryInfo extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
