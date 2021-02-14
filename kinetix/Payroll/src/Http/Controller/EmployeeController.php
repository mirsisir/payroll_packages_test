<?php

namespace kinetix\payroll\Http\Controller;

use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\SalaryInfo;
use kinetix\payroll\Models\SalarySheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    public function show(Employee $employee)
    {
        return view('Payroll::employees.show', compact('employee'));
    }



//    public function make_payments($id){
//
//        $employee = Employee::find($id);
//        View::share('title','Make Payments ');
//
//        return view('livewire.salary.make_payments',compact('employee'));
//    }

    public function pay( $e_id , $month){
         $payslip= SalarySheet::where('employee_id',$e_id)
                                ->where('date' ,$month )
                                    ->where('client_id',auth()->user()->client_id ??null)
                                        ->first();


        return view('Payroll::payslip', compact('payslip'));

    }

    public function payslip(){

        $employee = SalarySheet::where('client_id',auth()->user()->client_id ??null)->get();

        return view('Payroll::payslip_generate', compact('employee'));
    }
    public function payslip_redirect(Request $request){
        $validated = $request->validate([
            'employee' => 'required',
            'month' => 'required',
        ]);


        return redirect('payslip/'.(\request('employee')).('/').(\request('month')));

    }

    public function print_user($employee){
        $emp = Employee::findOrFail($employee);
        $emp_sal= SalaryInfo::firstWhere('employee_id',$employee);

        return view('Payroll::employees.profile',compact('emp' ,'emp_sal'));
    }




}
