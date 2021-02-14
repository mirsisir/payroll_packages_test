@extends('Payroll::layouts.app-hrm')

@section('title', 'Holidays')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('holiday.crud')

    </div>
</div>


@endsection
