<?php

namespace kinetix\payroll\Http\Livewire\Employee;


use Illuminate\Support\Facades\DB;
use kinetix\payroll\Models\Department;
use kinetix\payroll\Models\Designation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $fname;
    public $lname;
    public $dob;
    public $gender;
    public $status;
    public $father;
    public $nation = 'Bangladeshis';
    public $nid;
    public $photo;

    public $address;
    public $city;
    public $country = 'Bangladesh';
    public $mobile;
    public $phone;
    public $email;

    public $bank;
    public $branch;
    public $acc_name;
    public $acc_number;

    public $emp_id;
    public $department_id;
    public $designation_id;
    public $join_date;

    public $resume;
    public $offer_let;
    public $join_let;
    public $contact_paper;
    public $id_proff;
    public $other;

    public function mount ()
    {
        $this->join_date = date('Y-m-d');
    }

    public function store()
    {
        $data = $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => '',
            'father' => '',
            'nation' => 'required',
            'nid' => 'required',
            'photo' => 'required',

            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'email' => 'required',

            'bank' => '',
            'branch' => '',
            'acc_name' => '',
            'acc_number' => '',

            'emp_id' => 'required|unique:employees',
            'department_id' => 'required',
            'designation_id' => 'required',
            'join_date' => '',

            'resume' => '',
            'offer_let' => '',
            'join_let' => '',
            'contact_paper' => '',
            'id_proff' => '',
            'other' => '',
        ]);

        $user_id = auth()->user()->id;
        if($this->photo){
            $photoPath = $this->photo->store('photos', 'public');
            $photoArray = ['photo' => $photoPath];
        }
        if($this->resume){
            $resumePath = $this->resume->store('files', 'public');
            $resumeArray = ['resume' => $resumePath];
        }
        if($this->offer_let){
            $offer_letPath = $this->offer_let->store('files', 'public');
            $offer_letArray = ['offer_let' => $offer_letPath];
        }
        if($this->join_let){
            $join_letPath = $this->join_let->store('files', 'public');
            $join_letArray = ['join_let' => $join_letPath];
        }
        if($this->contact_paper){
            $contact_paperPath = $this->contact_paper->store('files', 'public');
            $contact_paperArray = ['contact_paper' => $contact_paperPath];
        }
        if($this->id_proff){
            $id_proffPath = $this->id_proff->store('files', 'public');
            $id_proffArray = ['id_proff' => $id_proffPath];
        }
        if($this->other){
            $otherPath = $this->other->store('files', 'public');
            $otherArray = ['other' => $otherPath];
        }

        DB::table('employees')->insert(array_merge(

            $data,
            $photoArray ?? [],
            $resumeArray ?? [],
            $offer_letArray ?? [],
            $join_letArray ?? [],
            $contact_paperArray ?? [],
            $id_proffArray ?? [],
            $otherArray ?? [],

        ));
        session()->flash('success', 'Employee successfully Inserted.');
        return redirect('/employees');
    }

    public function render()
    {
        $client_id = auth()->user()->client_id ?? null;
        $departments = Department::where('client_id', $client_id)->get();
        $designations = [];

        if($this->department_id)
        {
            $dept = Department::find($this->department_id);
            $designations = $dept->designations()->get();
        }

        return view('Payroll::livewire.employee.create', compact('departments', 'designations'))->layout('Payroll::layouts.app-hrm');
    }
}
