<?php

namespace kinetix\payroll\Http\Livewire\Loan;

use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Loan;
use Livewire\Component;

class Create extends Component
{
    public $searchEmp;
    public $approve_date;
    public $repay_from;
    public $amount;
    public $install_period;
    public $repay_total;
    public $installment;
    public $note;
    public $employee_id;
    public $emp_id;
    public $emp_name;

    public function mount()
    {
        $this->approve_date = date('Y-m-d');
        $this->repay_from = date('Y-m-d');
    }

    public function store()
    {
        $data = $this->validate([
            'employee_id' => 'required',
            'approve_date' => 'required',
            'repay_from' => 'required',
            'amount' => 'required',
            'install_period' => 'required',
            'repay_total' => 'required',
            'installment' => 'required',
            'note' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Loan::create($data);
        session()->flash('success', 'Loan Successfully Granted.');
        return redirect('/loans');
    }

    public function render()
    {
        $this->dispatchBrowserEvent('livewire:load');

        $this->repay_total = $this->amount;

        if($this->amount && $this->install_period)
        {
            $this->installment = round($this->amount / $this->install_period)+1;
        }

        $client_id = auth()->user()->client_id;
        $employees = Employee::where('client_id', $client_id)->get();

        return view('livewire.loan.create', compact('employees'))
                    ->extends('layouts.app-hrm');
    }
}
