<div>
    <style>
        .card .card-body {
            /*padding: 1.0rem 2.0rem;*/
        }
    </style>
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

    <div class=" row">
        <div class=" col-8  m-auto">
            <select name="dep" wire:model="department" id="" class="form-control width-100%">
                <option value=""> Select Department</option>
                @foreach($all_department as $department)
                    <option value="{{$department->id}}"> {{$department->department ?? " N/A"}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <br>
    <div class=" ">
        <div class="">
            <div class="">
                {{-- <div class="text-right">
                    <label>Search:</label>
                    <input wire:model.debounce.1000ms="search" class="border px-2 py-1 border-primary mb-1">
                </div> --}}
                <table id="table" class="table table-bordered table-responsive" >
                    <thead style="background-color: indigo; color: white;">
                    <tr>

                        <th> Name</th>
                        <th> EMP ID</th>
                        <th> Device ID</th>

                        <th> Department</th>
                        <th> Designation</th>
                        <th> Mobile</th>
                        <th> Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($employees as $i => $employee)
                        <tr>
                            <td>
                                <img src="/storage/{{ $employee->photo }}" width="30" height="30" class="mr-1">
                                {{ $employee->fname }} {{ $employee->lname }}
                            </td>
                            <td>{{ $employee->emp_id }}</td>
                            <td>{{ $employee->device_id }}</td>

                            <td>{{ $employee->department->department?? " " }} </td>
                            <td>{{ $employee->designation->name?? " " }} </td>
                            <td>{{ $employee->mobile }} </td>
                            <td class="text-center">
                                <a href="/employees/{{ $employee->id }}" class="btn btn-primary btn-sm">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path fill-rule="evenodd"
                                              d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a>
                                <a href="/employees/{{ $employee->id }}/edit" class="btn btn-info btn-sm">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <a class="btn btn-danger btn-sm" onclick="EmpID({{$employee->id}})"
                                   data-toggle="modal" data-target="#deleteModal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7"><span class="badge badge-danger font-weight-bold">No Employee To Show</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade text-dark" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info px-4" data-dismiss="modal">No</button>

                    <button id="deleteForm" type="submit" class="btn btn-danger px-4">Yes</button>
                    <input id="deleteForm" type="submit" class="btn btn-danger px-4">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function EmpID(eid) {
        var form = document.getElementById("deleteForm");
        // form.setAttribute("action", "/loans/"+lid);
        form.setAttribute("wire:click", "destroy(" + eid + ")");
    }
</script>


<script>
    $(document).ready(function () {
        var headingExcel = '{{ auth()->user()->name }}';
        var headingPrint = '<h1 id="heading" class="text-center text-dark">{{ auth()->user()->name }}</h1>' +
            '<h2 class="text-center text-dark">Address, Address, Address</h2>' +
            '<h4 class="text-center text-dark pt-2">Employee List</h4>';
        var headingPDF = '{{ auth()->user()->name }}' + '\n' + '{{ auth()->user()->email }}';

        var table = $('#table').DataTable({
            // responsive: true,
            dom: "<'row '<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'copy',
                    messageTop: '',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: '',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                },
                {
                    extend: 'excel',
                    messageTop: headingExcel,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: '',
                },
                {
                    extend: 'pdf',
                    title: headingPDF,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: headingPrint,
                }

            ]
        });


    });
</script>
