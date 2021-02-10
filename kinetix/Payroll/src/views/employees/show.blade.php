@extends('layouts.app-hrm')

@section('title', 'Employee Details')

@section('content')

<div class="row text-dark">
    <div class="col-md-12">

        <div class="d-flex">
            <div class="card text-center mr-4" style="width: 18rem;">
                <img class="card-img-top" height="300px" src="/storage/{{$employee->photo}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$employee->fname}}  {{ $employee->lname}}</h5>
                    <h6 class="card-subtitle mb-2">{{ $employee->employee_id}}</h6>
                <p class="card-text">{{ $employee->department->department ?? " N/A" }} - {{ $employee->designation->name ?? " N/A"}}</p>
                </div>
            </div>

            <div class="card w-75">
                <div class="card-header">
                  Personal Details
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$employee->fname}}  {{ $employee->lname}}</td>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td>{{$employee->father}}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{$employee->dob}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{$employee->gender}}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{$employee->mobile}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$employee->phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$employee->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex mt-4">
            <div class="card w-100">
                <div class="card-header">
                   Bank Information
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{$employee->bank}}</td>
                        </tr>
                        <tr>
                            <th>Branch Name</th>
                            <td>{{$employee->branch}}</td>
                        </tr>
                        <tr>
                            <th>Account Name</th>
                            <td>{{$employee->acc_name}}</td>
                        </tr>
                        <tr>
                            <th>Account Number</th>
                            <td>{{$employee->acc_number}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
{{--        <div class="card w-100 mt-4">--}}
{{--            <div class="card-header">--}}
{{--               Offial Document--}}
{{--            </div>--}}
{{--            <table class="table">--}}
{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <th>Resume</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->resume)--}}
{{--                                <iframe src="/storage/{{ $employee->resume }}" frameborder="0" style="width:100%;min-height:200px;"></iframe>--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>Offer Letter</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->offer_let)--}}
{{--                            <iframe src="/storage/{{ $employee->offer_let }}" frameborder="0" style="width:100%;min-height:200px;"></iframe></td>--}}
{{--                            @endif--}}

{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>Join Letter</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->join_let)--}}
{{--                            <iframe src="/storage/{{ $employee->join_let }}" frameborder="0" style="width:100%;min-height:200px;"></iframe></td>--}}
{{--                            @endif--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>Contact Paper</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->contact_paper)--}}
{{--                            <iframe src="/storage/{{ $employee->contact_paper }}" frameborder="0" style="width:100%;min-height:200px;"></iframe></td>--}}
{{--                            @endif--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>ID Proff</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->id_proff)--}}
{{--                            <iframe src="/storage/{{ $employee->id_proff }}" frameborder="0" style="width:100%;min-height:200px;"></iframe></td>--}}
{{--                            @endif--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>Other</th>--}}
{{--                        <td>--}}
{{--                            @if($employee->other)--}}
{{--                            <iframe src="/storage/{{ $employee->other }}" frameborder="0" style="width:100%;min-height:200px;"></iframe></td>--}}
{{--                            @endif--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
    </div>


</div>


<div class="text-center mt-5"> <a href="{{route('print_user',$employee->id)}}" type="button" class="btn btn-success">Print</a>
</div>

@endsection
