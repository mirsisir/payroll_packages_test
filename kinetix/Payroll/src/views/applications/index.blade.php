@extends('Payroll::layouts.app-hrm')

@section('title', 'Leave Application List')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('application.index')

    </div>
</div>


@endsection
