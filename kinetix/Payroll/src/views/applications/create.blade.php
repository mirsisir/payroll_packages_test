@extends('Payroll::layouts.app-hrm')

@section('title', 'Add Leave Application')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        @livewire('application.create')

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@endsection
