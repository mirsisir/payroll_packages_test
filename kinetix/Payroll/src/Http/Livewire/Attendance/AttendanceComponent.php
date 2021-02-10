<?php

namespace kinetix\payroll\Http\Livewire\Attendance;

use kinetix\payroll\Models\Attendance;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class AttendanceComponent extends Component
{
    public $month;
    public $all_employee;
    public $selected_month;
    public $working_days = [];
    public $attendance = [];
    public $selects = [];

    public $client_id;


    public function presentAll($x){

        foreach($this->all_employee as  $employee){
            $key= $employee->id. '-' . $this->month;

            $dbRecord = Attendance::where('Key', $key)->where('client_id',$this->client_id);

            if ($dbRecord->count()) {
                $dbRecord = $dbRecord->first();
                $this->attendance = json_decode($dbRecord->attendance, true) ?? [];

            } else {
                $dbRecord = Attendance::create(['Key' => $key, 'month' => $this->month, 'employee_id' => $e_id]);
                $this->attendance = [];
            }
            if (in_array($x, $this->attendance)) {
                $this->attendance = array_filter($this->attendance, function ($item) use ($x) {
                    return $item !== $x;
                });
            } else {
                array_push($this->attendance, $x);

            }
            $dbRecord->attendance = json_encode($this->attendance);
            $dbRecord->save();
            $this->reset(['attendance']);
        }
    }


    public function present($e_id, $date)
    {
        $key = $e_id . '-' . $this->month;
        $dbRecord = Attendance::where('Key', $key)->where('client_id',$this->client_id);

        if ($dbRecord->count()) {
            $dbRecord = $dbRecord->first();
            $this->attendance = json_decode($dbRecord->attendance, true) ?? [];

        } else {
            $dbRecord = Attendance::create(['Key' => $key, 'month' => $this->month, 'employee_id' => $e_id]);
            $this->attendance = [];
        }
        if (in_array($date, $this->attendance)) {
            $this->attendance = array_filter($this->attendance, function ($item) use ($date) {
                return $item !== $date;
            });
        } else {
            array_push($this->attendance, $date);

        }
        $dbRecord->attendance = json_encode($this->attendance);
        $dbRecord->save();
        $this->reset(['attendance']);


    }

    public function mount()
    {
        $this->client_id= auth()->user()->client_id;
        $this->month = Carbon::now()->format('Y-m');
        View::share('title', 'Attendance ');

        $this->all_employee = Employee::all()->where('client_id',$this->client_id);

        $workingday = WorkingDay::where('client_id',$this->client_id)->first();
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


    public function render()
    {
        return view('livewire.attendance.attendance-component')->layout('layouts.app-hrm');
    }
}
