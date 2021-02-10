<?php

namespace kinetix\payroll\Http\Livewire\Loan;

use kinetix\payroll\Models\Loan;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    protected $queryString = ['search'];

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        $client_id = auth()->user()->client_id;
        $loans = Loan::where('client_id', $client_id)
                ->whereHas('employee', function ($query) {
                    $query->where('emp_id', 'like', '%' . $this->search . '%')
                          ->orWhere('fname', 'like', '%' . $this->search . '%')
                          ->orWhere('lname', 'like', '%' . $this->search . '%');
                })->get();

        return view('livewire.loan.index', compact('loans'))->extends('layouts.app-hrm');
    }
}
