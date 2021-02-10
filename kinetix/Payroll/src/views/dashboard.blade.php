@extends('Payroll::layouts.app-hrm')

@section('title', 'Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row">



</div>


@endsection
