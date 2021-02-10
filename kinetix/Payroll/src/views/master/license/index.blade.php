@extends('master.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Licenses List
                        <div class="float-right">
                            <a role="button" class="btn btn-success" href="{{ route('license.create')}}">+ Add New
                                License</a>
                        </div>


                    </div>

                    <table class="table table-light">
                        <thead>
                        <tr>
                            <td>
                                #ID
                            </td>
                            <td>
                                License Key
                            </td>
                            <td>
                                License Duration
                            </td>
                            <td>
                                Remaining Days
                            </td>

                            <td>
                                Using By
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($licenses as $license)
                            <tr>
                                <td>{{$license->id}}</td>
                                <td>{{$license->license}}</td>

                                <td>{{ \Carbon\Carbon::createFromDate($license->start_at)->diffInDays(\Carbon\Carbon::createFromDate($license->end_at)) }}
                                    Days
                                </td>
                                <td>{{ \Carbon\Carbon::createFromDate($license->end_at)->diffInDays(\Carbon\Carbon::today()) }}
                                    Days
                                </td>

                                @php($user=\kinetix\payroll\Models\User::query()->where('license_id',$license->id)->get())
                                <td>{{ $user->first()==null?'Not Used':$user->first()->name }}</td>

                                <td>
                                    <a role="button" class="btn btn-primary btn-sm"
                                       href="{{ route('license.edit',$license->id)}}">Edit</a>
                                    <a role="button" class="btn btn-info  btn-sm"
                                       href="{{ route('license.show',$license->id)}}">Details</a>
                                    <a role="button" class="btn btn-danger  btn-sm" href="#">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $licenses->links() }}


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
