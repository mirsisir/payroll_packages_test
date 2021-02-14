<?php

namespace kinetix\payroll\Http\Livewire\LeaveCategory;

use kinetix\payroll\Models\LeaveCategory;
use Livewire\Component;

class Crud extends Component
{
    public $category_name;
    public $updateCategory = false;
    public $updateID;

    public function mount()
    {
        $this->category_name = '';
    }

    public function store()
    {
        $data = $this->validate([
            'category_name' => 'required'
        ]);
        auth()->user()->leave_categories()->create($data);
        session()->flash('success', 'Leave Category successfully Inserted.');
        $this->mount();
    }

    public function edit(LeaveCategory $leave_category)
    {
        $this->updateCategory = true;
        $this->updateID = $leave_category->id;
        $this->category_name = $leave_category->category_name;
    }

    public function update()
    {
        $data = $this->validate([
            'category_name' => 'required'
        ]);

        $cat = LeaveCategory::find($this->updateID);
        $cat->category_name = $data['category_name'];
        $cat->save();

        session()->flash('success', 'Leave Category successfully Updated.');
        $this->mount();
    }

    public function destroy(LeaveCategory $leave_category)
    {
        $leave_category->delete();
        session()->flash('danger', 'Leave Category successfully Deleted.');
    }

    public function render()
    {
        $client_id = auth()->user()->client_id ?? null;
        $leave_categories = LeaveCategory::where('client_id', $client_id)->get();

        return view('Payroll::livewire.leave-category.crud', compact('leave_categories'));
    }
}
