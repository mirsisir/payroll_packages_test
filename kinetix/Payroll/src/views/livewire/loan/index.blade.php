<div>
    @section('title', 'Loan List')
    <div class="d-xl-flex justify-content-between align-items-start">
        {{-- <h2 class="text-dark font-weight-bold mb-4"> Loan List </h2> --}}
        
    </div>

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
            <a href="/loans/create" class="btn btn-primary">Add Loan</a>
        </div>
    </div>
    <div class=" grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="table" class="table table-bordered" style="width:100%;">
                    <thead>
                        <tr class="font-weight-bold">
                            <th  class="font-weight-bold"> # </th>
                            <th class="font-weight-bold"> EMP ID </th>
                            <th class="font-weight-bold"> Name </th>
                            <th class="font-weight-bold"> Amount </th>
                            <th class="font-weight-bold"> Installment Period </th>
                            <th class="font-weight-bold"> Repayment Total </th>
                            <th class="font-weight-bold"> Approve Date </th>
                            <th class="font-weight-bold"> Repayment From </th>
                            <th class="font-weight-bold"> Option </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loans as $i => $loan)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $loan->employee->emp_id }}</td>
                                <td>{{ $loan->employee->fname }} {{ $loan->employee->lname }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->install_period }}</td>
                                <td>{{ $loan->repay_total }}</td>
                                <td>{{ date('d-m-Y', strtotime($loan->approve_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($loan->repay_from)) }}</td>
                                <td>
                                    <a href="/loans/{{$loan->id}}" class="btn btn-primary btn-sm">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg></a>
                                    <button class="btn btn-danger btn-sm delete-loan" onclick="loanID({{$loan->id}})"
                                    data-toggle="modal" data-target="#deleteModal">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="10"><span class="badge badge-info">No Loans To Show</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-dark" id="deleteModal">
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
                    <form method="post" id="deleteForm">
                        @method('DELETE')
                        @csrf
                        
                        <button type="submit" class="btn btn-danger px-4">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function loanID(lid){
        var form = document.getElementById("deleteForm");
        form.setAttribute("action", "/loans/"+lid);
    }
</script>


<script>
    $(document).ready(function() {
        // $('#table').css('display','table') ;

        var headingExcel =  '{{ auth()->user()->name }}';
        var headingPrint =  '<h1 id="heading" class="text-center text-dark">{{ auth()->user()->name }}</h1>' + 
                            '<h2 class="text-center text-dark">Address, Address, Address</h2>' + 
                            '<h4 class="text-center text-dark pt-2">Application List</h4>';
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
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    title: '',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                },
                {
                    extend: 'excel',
                    messageTop: headingExcel,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    title: '',
                },
                {
                    extend: 'pdf',
                    title: headingPDF,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    title: headingPrint,
                }
                
            ]
        } );
    } );
</script>