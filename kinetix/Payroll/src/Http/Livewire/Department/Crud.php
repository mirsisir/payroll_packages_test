<?php

namespace kinetix\payroll\Http\Livewire\Department;

use Livewire\Component;
use kinetix\payroll\Models\Department;

class Crud extends Component
{
    public $designations = [];
    public $department;
    public $updateID;
    public $updateDept = false;

    public function mount ()
    {
        $this->designations = [''];
        $this->department = '';
    }

    public function addDesignation()
    {
        $this->designations[] = [''];
    }

    public function removeDesignation($index)
    {
        unset($this->designations[$index]);
    }

    public function store()
    {
        $data = $this->validate([
            'department' => 'required|unique:departments',
            'designations.*' => 'required|min:3',
        ]);

        $dept = auth()->user()->departments()->create([
            'department' => $data['department']
        ]);

        foreach($this->designations as $designation)
        {
            $dept->designations()->create([
                'name' => $designation
            ]);
        }
        $this->mount();
        session()->flash('success', 'Department successfully Inserted.');
    }

    public function edit(Department $dept)
    {
        $this->updateDept = true;

        $this->updateID = $dept->id;
        $this->department = $dept->department;
        $this->designations = $dept->designations()->pluck('name');
    }

    public function update()
    {
        $data = $this->validate([
            'department' => 'required',
            'designations.*' => 'required|min:3',
        ]);

        $dept = Department::find($this->updateID);
        $dept->department = $this->department;
        $dept->save();

        $dept->designations()->delete();
        foreach($this->designations as $designation)
        {
            $dept->designations()->create([
                'name' => $designation
            ]);
        }

        $this->updateDept = false;
        $this->mount();
        session()->flash('success', 'Department successfully Updated.');
    }

    public function destroy(Department $id)
    {
        $id->designations()->delete();
        $id->delete();
        session()->flash('danger', 'Department successfully Deleted.');
    }

    public function render()
    {

        $departments = Department::all();

        return view('Payroll::livewire.department.crud', compact('departments'))->layout('layouts.admin.base');
    }
}
