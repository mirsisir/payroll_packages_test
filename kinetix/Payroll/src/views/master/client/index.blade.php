@extends('master.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Client List
                    <div class="float-right">
                        <a role="button" class="btn btn-success" href="{{ route('clients.create')}}">+ Add New Client</a>
                    </div>



                </div>

                <table class="table table-light">
                    <thead>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                Role
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->role}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                <a role="button" class="btn btn-primary btn-sm" href="{{ route('clients.edit',$client->id)}}">Edit</a>
                                <a role="button" class="btn btn-info  btn-sm" href="{{ route('clients.show',$client->id)}}">Details</a>
                                <a role="button" class="btn btn-danger  btn-sm" href="#">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
</div>
@endsection
