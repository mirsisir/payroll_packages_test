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
    <div class=" grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <table id="table" class="table" width="100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th> # </th>
                            <th> Event Name </th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Option </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($holidays as $i => $holiday)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $holiday->event_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($holiday->start)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($holiday->end)) }}</td>
                                <td>
                                <a href="/holidays/{{ $holiday->id }}/edit" class="btn btn-info btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                  </svg></a>
                                    <a wire:click.prevent="destroy({{ $holiday->id }})" class="btn btn-danger btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg></a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5"><span class="badge badge-info">No Employee To Show</span></td>
                            </tr> 
                        @endforelse

                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var headingExcel =  '{{ auth()->user()->name }}';
        var headingPrint =  '<h1 id="heading" class="text-center text-dark">{{ auth()->user()->name }}</h1>' + 
                            '<h2 class="text-center text-dark">Address, Address, Address</h2>' + 
                            '<h4 class="text-center text-dark pt-2">Holiday List</h4>';
        var headingPDF = '{{ auth()->user()->name }}' + '\n' + '{{ auth()->user()->email }}';

        $('#table').DataTable( {
            dom:"<'row '<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'copy',
                    messageTop: '',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    },
                    title: '',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    },
                },
                {
                    extend: 'excel',
                    messageTop: headingExcel,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    },
                    title: '',
                },
                {
                    extend: 'pdf',
                    title: headingPDF,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    },
                    title: headingPrint,
                }
                
            ]
        } );
    } );
</script>