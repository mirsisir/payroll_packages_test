@extends('Payroll::layouts.app-hrm')

@section('title', 'Leave Category')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('leave-category.crud')

    </div>
</div>

@endsection
