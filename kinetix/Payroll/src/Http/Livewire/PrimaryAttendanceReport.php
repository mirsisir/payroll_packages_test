<?php

namespace kinetix\payroll\Http\Livewire;

use kinetix\payroll\Models\Application;
use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Designation;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Holiday;
use kinetix\payroll\Models\WorkingDay;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class PrimaryAttendanceReport extends Component
{
    public $all_department, $all_designation, $all_employee = [];
    public $month, $department;
    public $day_count_month,$holidays=0,$total_offday;

    public function updatedMonth(){

    }

    public function mount()
    {
        $this->month = Carbon::now()->format('Y-m');
        View::share('title', 'Attendance Report Primary');
        $this->all_department = Department::all()->where('client_id', auth()->user()->client_id ?? null);
        $this->all_designation = Designation::all()->where('client_id', auth()->user()->client_id ?? null);
    }
    function dayCount($day, $month, $year){
        $totalDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $count = 0;
        for ($i = 1; $totalDay >= $i; $i++) {

            if (date('l', strtotime($year . '-' . $month . '-' . $i)) == ucwords($day)) {
                $count++;
            }
        }
        return $count;
    }

    public function updated()
    {
        $this->all_employee = Employee::all()->where('department_id', $this->department)
            ->where('client_id', auth()->user()->client_id ?? null);

        $month = explode("-", $this->month)[1];
        $year = explode("-", $this->month)[0];
        $this->day_count_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);



        //        working day count ----------------------------------
        $holiday_days = [];
        $workingday = 0;
        $workingday = WorkingDay::firstWhere('client_id', auth()->user()->client_id ?? null);

        if ($workingday!=null){
            if ($workingday->sat == 0) {
                array_push($holiday_days, 'Saturday');
            }
            if ($workingday->sun == 0) {
                array_push($holiday_days, 'Sunday');
            }
            if ($workingday->mon == 0) {
                array_push($holiday_days, 'Monday');
            }
            if ($workingday->tue == 0) {
                array_push($holiday_days, 'Tuesday');
            }
            if ($workingday->wed == 0) {
                array_push($holiday_days, 'Wednesday');
            }
            if ($workingday->thu == 0) {
                array_push($holiday_days, 'Thursday');
            }
            if ($workingday->fri == 0) {
                array_push($holiday_days, 'friday');
            }
        }



        $this->total_offday = 0;
        foreach ($holiday_days as $day) {
            $this->total_offday += $this->dayCount($day, $month, $year);

        }


        //  holiday
        $this->holidays = [];
        $totalHolidays = Holiday::all();
        $startOfMonth = Carbon::createFromDate($this->month)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($this->month)->endOfMonth();

        foreach ($totalHolidays as $holiday) {

            $dateRange =CarbonPeriod::create($holiday->start, $holiday->end)->toArray();

            foreach ($dateRange as $date) {

                if ($date->between($startOfMonth, $endOfMonth)) {
                    array_push($this->holidays, $date);
                }
            }
        }

        $this->holidays =count($this->holidays);




    }








    public function render()
    {
        return view('Payroll::livewire.primary-attendance-report')->layout('Payroll::layouts.app-hrm');
    }
}
