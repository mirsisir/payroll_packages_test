@extends('Payroll::layouts.app-hrm')

@section('title', 'Employee List')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('employee.index')

    </div>
</div>


@endsection
