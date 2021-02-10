@extends('layouts.app-hrm')

@section('title', 'Holidays')

@section('content')


<div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
    <a href="/holidays/create" class="btn btn-success">Add Holiday</a>
</div>

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('holiday.crud')

    </div>
</div>


    
@endsection