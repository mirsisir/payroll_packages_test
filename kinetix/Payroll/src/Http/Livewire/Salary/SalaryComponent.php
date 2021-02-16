<?php

namespace kinetix\payroll\Http\Livewire\Salary;

use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\SalaryInfo;
use Illuminate\Support\Facades\View;
use kinetix\payroll\Models\SalarySheet;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class SalaryComponent extends Component
{
public  $basic_salary,$employee_type ="Permanent",$house_rent,$special_allowance,$medical,$fuel_allowance,$phone_bill,$other_allowance,$provident_fund,$tax,$other_deduction;
public $net_salary,$total_deduction,$gross_salary;
public $all_employee,$e_id,$employee_name;
public $edit= false;

//    public function updated($basic_salary,$house_rent){
//        $this->net_salary =+ $this->basic_salary + $this->house_rent;
//
//    }


    public function edit($e_id){
        $this->edit=true;
        $this->e_id= $e_id;
        $this->employee_name = Employee::find($e_id);
            $info = SalaryInfo::where('employee_id',$e_id)->firstWhere('client_id',auth()->user()->client_id ?? null);
            if (!empty($info)){


                $this->basic_salary = $info->basic_salary;

                $this->employee_type = $info->employee_type;
               $this->house_rent = $info->house_rent;
                $this->medical = $info->medical;
              $this->special_allowance = $info->special_allowance;
                $this->fuel_allowance = $info->fuel_allowance;
                $this->phone_bill = $info->phone_bill;
                $this->other_allowance = $info->other_allowance;

                $this->gross_salary = $info->gross_salary;

                $this->provident_fund = $info->provident_fund;
                $this->tax = $info->tax_deduction;
                $this->other_deduction = $info->other_deduction;
                $this->net_salary = $info->net_salary;
                $this->employee_name = Employee::find($e_id);
            }
    }

    public function cansel(){
        $this->edit=false;
        $this->reset(['e_id']);
    }


    public function save(){

        $this->validate([

            'basic_salary' => 'required',
            'employee_type' => 'required',

        ]);

        $this->gross_salary = $this->basic_salary+$this->house_rent +$this->medical +$this->special_allowance +$this->fuel_allowance+$this->phone_bill+$this->other_allowance;
        $this->total_deduction = $this->provident_fund+$this->tax + $this->other_deduction;
        $salary_info = SalaryInfo::updateOrCreate(
          [ 'employee_id'=>$this->e_id ],

            ['employee_type'=>$this->employee_type,
                'basic_salary' =>$this->basic_salary,
                'house_rent' =>$this->house_rent,
                'medical' =>$this->medical,
                'special_allowance' =>$this->special_allowance,
                'fuel_allowance' =>$this->fuel_allowance,
                'phone_bill' =>$this->phone_bill,
                'other_allowance' =>$this->other_allowance,

                'gross_salary' =>$this->gross_salary,

                'provident_fund' =>$this->provident_fund,
                'tax_deduction' =>$this->tax,
                'other_deduction' =>$this->other_deduction,
                'total_deduction' =>$this->total_deduction,


                'net_salary' =>$this->gross_salary-$this->provident_fund-$this->tax-$this->other_deduction ,



                ]
        );

        $this->reset(['net_salary','basic_salary','employee_type','house_rent','medical','special_allowance','phone_bill','other_allowance','gross_salary','provident_fund','other_deduction','tax','e_id']);

        $this->edit=false;

    }

    public function create_salary_sheet()
    {
        $salary_infos = SalaryInfo::where('client_id',auth()->user()->client_id ?? null)->get();
        foreach($salary_infos as $salary_info)
        {
            SalarySheet::updateOrCreate(
            ['date' => date('Y-m'), 'employee_id' => $salary_info->employee_id,],

            ['employee_type'=>$salary_info->employee_type,
            'basic_salary' =>$salary_info->basic_salary,
            'house_rent' =>$salary_info->house_rent,
            'medical' =>$salary_info->medical,
            'special_allowance' =>$salary_info->special_allowance,
            'fuel_allowance' =>$salary_info->fuel_allowance,
            'phone_bill' =>$salary_info->phone_bill,
            'other_allowance' =>$salary_info->other_allowance,

            'gross_salary' =>$salary_info->gross_salary,

            'provident_fund' =>$salary_info->provident_fund,
            'tax_deduction' =>$salary_info->tax_deduction,
            'other_deduction' =>$salary_info->other_deduction,
            'total_deduction' =>$salary_info->total_deduction,
            'net_salary' => $salary_info->net_salary,
            'Due' => $salary_info->net_salary,
            'client_id' => auth()->user()->client_id ?? null,
            ]);
        }

        return redirect('/salary-sheet');
    }


    public function mount(){
        View::share('title','Employee Salary Info');

        $this->all_employee =Employee::all()->where('client_id',auth()->user()->client_id ?? null);
    }

    public function render()
    {
        return view('Payroll::livewire.salary.salary-component')->layout('Payroll::layouts.app-hrm');
    }
}
