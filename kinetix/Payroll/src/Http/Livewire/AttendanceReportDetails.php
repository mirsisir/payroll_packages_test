<?php

namespace kinetix\payroll\Http\Livewire;

use kinetix\payroll\Models\Attendance;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class AttendanceReportDetails extends Component
{
    public $employee,$month;
    public $all_employee=[] ,$attendance,$working_days=[];

    public function mount(){
        view::share( 'title', 'Attendance Report Details');
        $this->month = Carbon::now()->format('Y-m');

        $this->all_employee = Employee::all()->where('client_id',auth()->user()->client_id);

        $this->attendance= Attendance::where('client_id',auth()->user()->client_id)->get();

        $workingday = WorkingDay::where('client_id',auth()->user()->client_id)->first();
        if(!empty($workingday)){
            if ($workingday->sat == 0) {
                array_push($this->working_days, 'Sat');
            }
            if ($workingday->sun == 0) {
                array_push($this->working_days, 'Sun');
            }
            if ($workingday->mon == 0) {
                array_push($this->working_days, 'Mon');
            }
            if ($workingday->tue == 0) {
                array_push($this->working_days, 'Tue');
            }
            if ($workingday->wed == 0) {
                array_push($this->working_days, 'Wed');
            }
            if ($workingday->thu == 0) {
                array_push($this->working_days, 'Thu');
            }
            if ($workingday->fri == 0) {
                array_push($this->working_days, 'Fri');
            }
        }

    }


    public function updated(){
        if($this->employee){
            $this->all_employee = [];
            $this->all_employee[] = Employee::find($this->employee);
        }

    }


    public function render()
    {
        return view('livewire.attendance-report-details')->layout('layouts.app-hrm');
    }
}
