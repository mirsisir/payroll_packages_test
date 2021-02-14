<?php

namespace kinetix\payroll\Http\Livewire\Holiday;


use kinetix\payroll\Models\Holiday;
use Livewire\Component;

class Crud extends Component
{
    public $event_name;
    public $description;
    public $start;
    public $end;

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        session()->flash('danger', 'Holiday successfully Deleted.');
    }

    public function render()
    {
        $client_id = auth()->user()->client_id ?? null;
        $holidays = Holiday::where('client_id', $client_id)->get();

        return view('Payroll::livewire.holiday.crud', compact('holidays'))->layout('Payroll::layouts.app-hrm');
    }
}
