<?php

namespace kinetix\payroll\Http\Livewire\Employee;

use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Employee;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $search ,$employees ,$all_department,$department;
    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount(){
        $this->all_department = Department::all()->where('client_id', auth()->user()->client_id ?? null ?? null);

        $this->employees = Employee::where('client_id', auth()->user()->client_id ?? null ?? null)->get();

    }

     function updated(){

         $this->employees = Employee::all()->where('client_id', auth()->user()->client_id ?? null ?? null)
                                            ->where('department_id',$this->department);

     }

    public function destroy(Employee $employee)
    {
        $path = public_path().'/storage/';
        if($employee->photo)
        {
            $file_old = $path.$employee->photo;
            unlink($file_old);
        }
        if($employee->resume)
        {
            $file_old = $path.$employee->resume;
            unlink($file_old);
        }
        if($employee->offer_let)
        {
            $file_old = $path.$employee->offer_let;
            unlink($file_old);
        }
        if($employee->join_let)
        {
            $file_old = $path.$employee->join_let;
            unlink($file_old);
        }
        if($employee->contact_paper)
        {
            $file_old = $path.$employee->contact_paper;
            unlink($file_old);
        }
        if($employee->id_proff)
        {
            $file_old = $path.$employee->id_proff;
            unlink($file_old);
        }
        if($employee->other)
        {
            $file_old = $path.$employee->other;
            unlink($file_old);
        }
        $employee->delete();
        session()->flash('danger', 'Employee successfully Deleted.');
    }

    public function render()
    {
        $client_id = auth()->user()->client_id ?? null;


            // ->where('fname', 'like', '%'.$this->search.'%')
            // ->orWhere('lname', 'like', '%'.$this->search.'%')
            // ->orWhere('emp_id', 'like', '%'.$this->search.'%')
            // ->orWhere('mobile', 'like', '%'.$this->search.'%')
            // ->paginate(20);

        return view('Payroll::livewire.employee.index')->layout('Payroll::layouts.app-hrm');
    }
}
