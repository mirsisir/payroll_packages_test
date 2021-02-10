<?php

namespace kinetix\payroll\Http\Livewire\Salary;

use kinetix\payroll\Models\Application;
use kinetix\payroll\Models\Attendance;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Holiday;
use kinetix\payroll\Models\Loan;
use kinetix\payroll\Models\SalarySheet;
use kinetix\payroll\Models\User;
use kinetix\payroll\Models\WorkingDay;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\View;
use League\CommonMark\Block\Element\ThematicBreak;
use Livewire\Component;
use Carbon\Carbon;

class MakePaymentsComponent extends Component
{
    public $employee, $select_month, $fine_Deduction, $payment_type, $comments, $Payment_amount, $temp_Payment_amount, $net_salary, $Payable;
    public $total_working_day, $total_attendance, $day_count_month, $total_offday, $fine_each_day, $total_absent, $total_fine_by_date, $iid;
    public $holiday_days = [], $total_holiday;
    public $loan=0;

    public function mount($id)
    {
        $this->select_month= Carbon::now()->format('Y-m');

        View::share('title', 'Make Payments ');
        $this->employee = Employee::find($id);
        $this->iid = $id;

        $loan = Loan::where('employee_id' ,$id)->firstWhere('client_id',auth()->user()->client_id);


        $salary_s  = SalarySheet::where('date',$this->select_month)
            ->where('employee_id',$id)->first();
        $this->Payment_amount = $salary_s->Due;


        if($loan){
            if($loan->repay_total>=0){
                $this->loan = $loan->installment;
                $this->net_salary = $this->employee->salaryInfo->net_salary - $loan->installment;
                $this->Payment_amount = $salary_s->Due  - $loan->installment;

            }
        }


        $this->temp_Payment_amount = $this->Payment_amount;
//        $this->select_month = date("Y-m");




    }

    public function updatedFineeachday()
    {
        if ($this->fine_each_day > 0) {
            $fine = $this->total_absent * $this->fine_each_day;
            $this->total_fine_by_date = $fine;

            $this->Payment_amount = $this->employee->salaryInfo->net_salary - $this->total_fine_by_date;
        } else {
            $this->total_fine_by_date = 0;
            $this->Payment_amount = $this->employee->salaryInfo->net_salary ?? 0;
            $this->temp_Payment_amount = $this->Payment_amount;
        }

    }

    public function updatedLoan(){
        $salary_s  = SalarySheet::where('date',$this->select_month)
            ->where('employee_id',$this->iid)->first();
        $this->Payment_amount = $salary_s->Due;

        if($this->loan>0){
            $this->Payment_amount -= $this->loan;
        }
    }

    public function calculate()
    {

        $d = $this->employee->salaryInfo->net_salary;

        $this->fine_each_day = round($d / $this->total_working_day);
        $this->total_fine_by_date = round($this->fine_each_day * $this->total_absent);
        $this->Payment_amount = $this->employee->salaryInfo->net_salary - $this->total_fine_by_date;
        $this->temp_Payment_amount = $this->Payment_amount;


    }


    public function make_payments(){



        $due = $this->temp_Payment_amount - $this->Payment_amount;

         $record = SalarySheet::where( 'employee_id',$this->iid)
                                    ->where('date' ,$this->select_month )->first();

         if($record->paid != $this->Payment_amount){
             $record->paid += $this->Payment_amount;
         }
         else{
             $record->paid = $this->Payment_amount;
         }
         $record->Due = $due;
         $record->fine = $this->total_fine_by_date;

         $record->save();

        $loan= Loan::where('employee_id',$this->iid)->first();
        if($loan){
            if($this->loan>0){
                $loan->repay_total	-= $this->loan;
                $loan->save();
            }

        }

//         return redirect (route('payslip'/$this->iid/$this->select_month));
        return redirect('payslip/'.($this->iid).('/').($this->select_month));





    }

    public function render()
    {

        $year = explode("-", $this->select_month)[0];
        $month = explode("-", $this->select_month)[1];


        $this->reset(['total_offday', 'total_working_day', 'total_absent', 'total_holiday']);


        $key = $this->iid.'-'.$year.'-'.$month;


        $dbRecord = Attendance::firstWhere('Key',$key);
//        $dbRecord = Attendance::take(1)->first()->Key;


        $attendance = json_decode(optional($dbRecord)->attendance, true  ) ?? [] ;

        $this->total_attendance = count($attendance);

        $this->day_count_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

//        how many friday in that month
        function dayCount($day, $month, $year)
        {
            $totalDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $count = 0;
            for ($i = 1; $totalDay >= $i; $i++) {

                if (date('l', strtotime($year . '-' . $month . '-' . $i)) == ucwords($day)) {
                    $count++;
                }
            }
            return $count;
        }

//        working day count ----------------------------------
        $this->holiday_days = [];
        $this->total_offday = 0;

        $workingday = WorkingDay::all()->first();
        if ($workingday->sat == 0) {
            array_push($this->holiday_days, 'Saturday');
        }
        if ($workingday->sun == 0) {
            array_push($this->holiday_days, 'Sunday');
        }
        if ($workingday->mon == 0) {
            array_push($this->holiday_days, 'Monday');
        }
        if ($workingday->tue == 0) {
            array_push($this->holiday_days, 'Tuesday');
        }
        if ($workingday->wed == 0) {
            array_push($this->holiday_days, 'Wednesday');
        }
        if ($workingday->thu == 0) {
            array_push($this->holiday_days, 'Thursday');
        }
        if ($workingday->fri == 0) {
            array_push($this->holiday_days, 'friday');
        }


        foreach ($this->holiday_days as $day) {
            $this->total_offday += dayCount($day, $month, $year);

        }


//        if their are any holiday in that month------------------------------------------


        $holidays = [];
        $totalHolidays = Holiday::all();
        $startOfMonth = Carbon::createFromDate($this->select_month)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($this->select_month)->endOfMonth();

        foreach ($totalHolidays as $holiday) {

            $dateRange = CarbonPeriod::create($holiday->start, $holiday->end)->toArray();
            foreach ($dateRange as $date) {
                if ($date->between($startOfMonth, $endOfMonth)) {
                    array_push($holidays, $date);
                }
            }

        }

        $leaves = [];

        $total_leave = Application::Where('employee_id',$this->iid)->get();
        $startOfMonth = Carbon::createFromDate($this->select_month)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($this->select_month)->endOfMonth();

        foreach ($total_leave as $holiday) {

            $dateRange = CarbonPeriod::create($holiday->start, $holiday->end)->toArray();
            foreach ($dateRange as $date) {
                if ($date->between($startOfMonth, $endOfMonth)) {
                    array_push($leaves, $date);
                }
            }

        }



        $this->total_offday += count($holidays);
        $this->total_offday += count($leaves);


//        if their are any holiday in that month------------------------------------------



        $this->total_working_day = $this->day_count_month - $this->total_offday;

        $this->total_absent = $this->total_working_day - $this->total_attendance ;

        return view('livewire.salary.make-payments-component')->layout('layouts.app-hrm');
    }
}
