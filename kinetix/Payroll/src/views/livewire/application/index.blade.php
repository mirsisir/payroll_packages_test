<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <div class="d-flex justify-content-between mb-2">
        <div class="">
            <a href="/applications/create" class="btn btn-primary">Add Leave Application</a>
        </div>
        <div class="d-flex">
            <div class="text-right mr-2">
                <input type="date" wire:model.debounce.1000ms="start" class="form-control form-control-sm" placeholder="">
            </div>
            <div class="text-right">
                <input type="date" wire:model.debounce.1000ms="end" class="form-control form-control-sm" placeholder="">
            </div>
        </div>
    </div>
    <div class=" grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <div class="d-flex">
                    <div class="text-left mr-2">
                        <label class="text-success font-weight-bold">Search: </label>
                        <input wire:model.debounce.1000ms="search" class="border px-2 py-1 border-success mb-1" placeholder="Search">
                    </div>
                </div> --}}
                <table id="table" class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th> # </th>
                            <th> EMP ID </th>
                            <th> Name </th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Leave Type </th>
                            <th> Reason </th>
                            <th> Option </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $i => $application)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $application->employee->emp_id }}</td>
                                <td>{{ $application->employee->fname }} {{ $application->employee->lname }}</td>
                                <td>{{ date('d-m-Y', strtotime($application->start)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($application->end)) }}</td>
                                <td>{{ $application->category->category_name }}</td>
                                <td>{{ $application->reason }}</td>
                                <td>
                                    {{-- <a href="/applications/{{ $application->id }}/edit" class="btn btn-info btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg></a> --}}
                                    <a wire:click.prevent="destroy({{ $application->id }})" class="btn btn-danger btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg></a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8"><span class="badge badge-info">No Applicatons To Show</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


{{--<script>--}}
{{--    window.addEventListener("livewire:load", function (event) {--}}

{{--    // $(document).ready(function() {--}}
{{--        var headingExcel =  '{{ auth()->user()->name }}';--}}
{{--        var headingPrint =  '<h1 id="heading" class="text-center text-dark">{{ auth()->user()->name }}</h1>' +--}}
{{--                            '<h2 class="text-center text-dark">Address, Address, Address</h2>' +--}}
{{--                            '<h4 class="text-center text-dark pt-2">Application List</h4>';--}}
{{--        var headingPDF = '{{ auth()->user()->name }}' + '\n' + '{{ auth()->user()->email }}';--}}

{{--        $('#table').DataTable( {--}}
{{--            dom:"<'row '<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +--}}
{{--                "<'row'<'col-sm-12'tr>>" +--}}
{{--                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",--}}
{{--            buttons: [--}}
{{--                {--}}
{{--                    extend: 'copy',--}}
{{--                    messageTop: '',--}}
{{--                    exportOptions: {--}}
{{--                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                    },--}}
{{--                    title: '',--}}
{{--                },--}}
{{--                {--}}
{{--                    extend: 'csv',--}}
{{--                    exportOptions: {--}}
{{--                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                    },--}}
{{--                },--}}
{{--                {--}}
{{--                    extend: 'excel',--}}
{{--                    messageTop: headingExcel,--}}
{{--                    exportOptions: {--}}
{{--                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                    },--}}
{{--                    title: '',--}}
{{--                },--}}
{{--                {--}}
{{--                    extend: 'pdf',--}}
{{--                    title: headingPDF,--}}
{{--                    exportOptions: {--}}
{{--                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                    },--}}
{{--                    customize: function (doc) {--}}
{{--                        doc.content[1].table.widths =--}}
{{--                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');--}}
{{--                    }--}}
{{--                },--}}
{{--                {--}}
{{--                    extend: 'print',--}}
{{--                    exportOptions: {--}}
{{--                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]--}}
{{--                    },--}}
{{--                    title: headingPrint,--}}
{{--                }--}}

{{--            ]--}}
{{--        } );--}}
{{--    // } );--}}
{{--    });--}}
{{--</script>--}}
