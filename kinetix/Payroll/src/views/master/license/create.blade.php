@extends('master.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                        <h3> Create New License</h3>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('license.store') }}" method="post">

                            @csrf
                            <div class="form-group">
                                <label for="">Starting Date</label>
                                <input type="date" name="start_at" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Ending Date</label>
                                <input type="date" class="form-control" name="end_at" required>
                            </div>


                            <button type="submit"> Submit</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
