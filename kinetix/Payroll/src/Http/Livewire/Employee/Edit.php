<?php

namespace kinetix\payroll\Http\Livewire\Employee;

use Livewire\Component;
use kinetix\payroll\Models\Employee;
use kinetix\payroll\Models\Department;
use Livewire\WithFileUploads;

class Edit extends Component
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
    public $updatePhoto;

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

    public $updateResume;
    public $updateOffer_let;
    public $updateJoin_let;
    public $updateContact_paper;
    public $updateId_proff;
    public $updateOther;

    public $employee;

    public function mount (Employee $employee)
    {
        $this->employee = $employee;

        $this->join_date = date('Y-m-d');
        $this->fname = $employee->fname;
        $this->lname = $employee->lname;
        $this->dob =  $employee->dob;
        $this->gender = $employee->gender;
        $this->status = $employee->status;
        $this->father = $employee->father;
        $this->nid = $employee->nid;
        $this->photo = $employee->photo;

        $this->address = $employee->address;
        $this->city = $employee->city;
        $this->mobile = $employee->mobile;
        $this->phone = $employee->phone;
        $this->email = $employee->email;

        $this->bank = $employee->bank;
        $this->branch = $employee->branch;
        $this->acc_name = $employee->acc_name;
        $this->acc_number = $employee->acc_number;

        $this->emp_id = $employee->emp_id;
        $this->department_id = $employee->department_id;
        $this->designation_id = $employee->designation_id;
        $this->join_date = $employee->join_date;

        $this->resume = $employee->resume;
        $this->offer_let = $employee->offer_let;
        $this->join_let = $employee->join_let;
        $this->contact_paper = $employee->contact_paper;
        $this->id_proff = $employee->id_proff;
        $this->other = $employee->other;
    }

    public function update()
    {
        $data = $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'father' => 'required',
            'nation' => 'required',
            'nid' => 'required',
            // 'photo' => 'required|image|max:1024',
            'photo' => '',

            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'email' => 'required',

            'bank' => '',
            'branch' => '',
            'acc_name' => '',
            'acc_number' => '',

            'emp_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'join_date' => 'required',

            'resume' => '',
            'offer_let' => '',
            'join_let' => '',
            'contact_paper' => '',
            'id_proff' => '',
            'other' => '',
        ]);

        $path = public_path().'/storage/';

        if($this->updatePhoto){
            $file_old = $path.$this->photo;
            unlink($file_old);

            $photoPath = $this->updatePhoto->store('photos', 'public');
            $photoArray = ['photo' => $photoPath];
        }

        if($this->updateResume){
            if($this->resume)
            {
                $file_old = $path.$this->resume;
                unlink($file_old);
            }
            $resumePath = $this->updateResume->store('files', 'public');
            $resumeArray = ['resume' => $resumePath];
        }

        if($this->updateOffer_let){
            if($this->offer_let)
            {
                $file_old = $path.$this->offer_let;
                unlink($file_old);
            }
            $offer_letPath = $this->updateOffer_let->store('files', 'public');
            $offer_letArray = ['offer_let' => $offer_letPath];
        }

        if($this->updateJoin_let){
            if($this->join_let)
            {
                $file_old = $path.$this->join_let;
                unlink($file_old);
            }
            $join_letPath = $this->updateJoin_let->store('files', 'public');
            $join_letArray = ['join_let' => $join_letPath];
        }

        if($this->updateContact_paper){
            if($this->contact_paper)
            {
                $file_old = $path.$this->contact_paper;
                unlink($file_old);
            }
            $contact_paperPath = $this->updateContact_paper->store('files', 'public');
            $contact_paperArray = ['contact_paper' => $contact_paperPath];
        }

        if($this->updateId_proff){
            if($this->id_proff)
            {
                $file_old = $path.$this->id_proff;
                unlink($file_old);
            }
            $id_proffPath = $this->updateId_proff->store('files', 'public');
            $id_proffArray = ['id_proff' => $id_proffPath];
        }

        if($this->updateOther){
            if($this->other)
            {
                $file_old = $path.$this->other;
                unlink($file_old);
            }
            $otherPath = $this->updateOther->store('files', 'public');
            $otherArray = ['other' => $otherPath];
        }



        $this->employee->update(array_merge(
            $data,
            $photoArray ?? [],
            $resumeArray ?? [],
            $offer_letArray ?? [],
            $join_letArray ?? [],
            $contact_paperArray ?? [],
            $id_proffArray ?? [],
            $otherArray ?? [],
        ));
        session()->flash('success', 'Employee successfully Updated.');
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

        return view('Payroll::livewire.employee.edit', compact('departments', 'designations'))
                ->extends('Payroll::employees.edit');
    }
}
