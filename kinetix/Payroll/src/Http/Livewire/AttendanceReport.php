<?php

namespace kinetix\payroll\Http\Livewire;

use kinetix\payroll\Models\Attendance;
use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Designation;
use kinetix\payroll\Models\Employee;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class AttendanceReport extends Component
{
    public $department,$designation,$employee;
    public $all_department,$all_designation,$all_employee;
    public $employee_a_record;
    public function mount(){
        View::share('title', 'Attendance Report ');
        $this->all_department = Department::all()->where('client_id',auth()->user()->client_id);
        $this->all_designation = Designation::all()->where('client_id',auth()->user()->client_id);
        $this->all_employee = Employee::all()->where('client_id',auth()->user()->client_id);
    }

    public function updatedDepartment(){
        $this->all_designation = Designation::all()->where('department_id',$this->department);

    }
    public function updatedDesignation(){

        $this->all_designation = Designation::all()->where('department_id',$this->department);

    }



    public function updatedEmployee()
    {
        $this->employee_a_record = Attendance::all()->where('employee_id',$this->employee);
    }


    public function render()
    {
        return view('livewire.attendance-report')->layout('layouts.app-hrm');
    }
}
