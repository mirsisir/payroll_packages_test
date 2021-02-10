@extends('layouts.app-hrm')

@section('title', 'Working Days')

@section('content')


<div class="d-xl-flex justify-content-between align-items-start">
    <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
        {{-- <button class="btn btn-primary"></button> --}}
    </div>
</div>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body">
                <h2 class="text-dark font-weight-bold mb-4"> Set Working Days </h2>
                <form action="/set-working-days" method="POST">

                    @csrf

                    <div class="form-group row text-dark">
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="sat" type="checkbox" class="form-check-input" @if($working_days->sat == 1) checked @endif> Saturday </label>
                        </div>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="sun" type="checkbox" class="form-check-input" @if($working_days->sun == 1) checked @endif> Sunday </label>
                        </div>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="mon" type="checkbox" class="form-check-input" @if($working_days->mon == 1) checked @endif> Monday </label>
                        </div>
                        <div class="form-check mx-3 ">
                            <label class="form-check-label">
                            <input name="tue" type="checkbox" class="form-check-input" @if($working_days->tue == 1) checked @endif> Tuesday </label>
                        </div>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="wed" type="checkbox" class="form-check-input" @if($working_days->wed == 1) checked @endif> Wednesday </label>
                        </div>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="thu" type="checkbox" class="form-check-input" @if($working_days->thu == 1) checked @endif> Thursday </label>
                        </div>
                        <div class="form-check mx-3">
                            <label class="form-check-label">
                            <input name="fri" type="checkbox" class="form-check-input" @if($working_days->fri == 1) checked @endif> Friday </label>
                        </div>
                        <div class="mx-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

    
@endsection