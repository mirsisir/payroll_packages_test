@extends('Payroll::layouts.app-hrm')

@section('title', 'Edit Employee')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('employee.edit')

    </div>
</div>

@endsection
