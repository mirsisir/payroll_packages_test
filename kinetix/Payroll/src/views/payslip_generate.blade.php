@extends('layouts.app-hrm')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card w-50 m-auto ">
        <div class="card-body">
            <form action="{{route('payslip_redirect')}}" method="POST">
                @csrf
                <label for="employee">Select Employee</label>

                <select name="employee" id="employee"  class="form-control" >
                    <option value = " "> Select Employee</option>
                @foreach($employee as $e)
                <option value="{{$e->employee_id}}">{{$e->employee->fname}} {{$e->employee->lname}}</option>
                    @endforeach

            </select>
            <br>
            <label for="month">Select Month</label>
            <input type="month" name="month" id="month" class="form-control">
                <input type="submit" value="Generate" class="float-right btn btn-primary mt-3">
            </form>
        </div>
    </div>
@endsection
