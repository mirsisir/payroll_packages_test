<?php

namespace kinetix\payroll\Http\Livewire;

use Livewire\Component;
use kinetix\payroll\Models\SalaryInfo;
use kinetix\payroll\Models\SalarySheet;

class SalarySheetDetail extends Component
{
    public $selectMonth;

    public function mount()
    {
        $this->selectMonth = date('Y-m');
    }

    public function render()
    {
        $client_id = auth()->user()->client_id;
        $salary_sheets = SalarySheet::where('client_id', $client_id)
                            ->where('date', $this->selectMonth)->get();

        return view('livewire.salary-sheet-detail', compact('salary_sheets'))
                    ->extends('layouts.app-hrm');
    }

}
