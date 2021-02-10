@extends('layouts.app-hrm')

@section('title', 'Edit Holiday')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form action="/holidays/{{ $holiday->id }}" method="POST" class="forms-sample">

                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="event_name" class="col-sm-2 col-form-label">Event Name</label>
                    <div class="col-sm-8">
                    <input type="text" name="event_name" value="{{ $holiday->event_name ?? old('event_name') }}" class="form-control @error('event_name') is-invalid @enderror" id="event_name" placeholder="Event Name">
                        @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <input type="text" name="description" value="{{ $holiday->description ?? old('description') }}" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="start" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="start" value="{{ date('Y-m-d', strtotime($holiday->start)) ?? old('start') }}" class="form-control @error('start') is-invalid @enderror" id="start" placeholder="Start Name">
                        @error('start')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-8">
                        <input type="date" name="end" value="{{ date('Y-m-d', strtotime($holiday->end)) ?? old('end') }}" class="form-control @error('end') is-invalid @enderror" id="end" placeholder="End Name">
                        @error('end')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-8 offset-sm-2">
                    <button type="submit" class="btn btn-info btn-block">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </div>
</div>

    
@endsection






