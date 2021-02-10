<?php

namespace kinetix\payroll\Http\Livewire\Application;

use kinetix\payroll\Models\Application;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\LeaveCategory;
use Livewire\Component;

class Create extends Component
{
    public $employee_id;
    public $category_id;
    public $start;
    public $end;
    public $reason;

    public function store()
    {
        $data = $this->validate([
            'employee_id' => 'required',
            'category_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'reason' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Application::create($data);
        session()->flash('success', 'Application Successfully Inserted.');
        return redirect('/applications');
    }

    public function render()
    {
        $this->dispatchBrowserEvent('livewire:load');

        $client_id = auth()->user()->client_id;
        $employees = Employee::where('client_id', $client_id)->get();
        $categories = LeaveCategory::where('client_id', $client_id)->get();

        return view('livewire.application.create', compact('employees', 'categories'));
    }
}
