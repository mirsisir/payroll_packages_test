<div>
    @section('title', 'Salary Sheet')

    <div class="grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-2">
                    <div class="">
                        <input type="month" wire:model.debounce.500ms="selectMonth" class="form-control form-control-sm" id="bdaymonth">
                    </div>
                </div>
                <div class="table-responsive" >
                    <div id="printSection">
                        <div class="text-center mb-2" id="heading" style="display: none;">
                            <h1>Company Name</h1>
                            <h3 class="mb-4">Addresss, Upazilla, Zilla</h3>
                            <h4>Salary Sheet For Month of {{ date('m-Y', strtotime($selectMonth)) }}</h4>
                        </div>
                        <table id="table" class="table" style="max-width: 2480px; width:100%;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="font-weight-bold"> # </th>
                                    <th class="font-weight-bold"> EMP ID </th>
                                    <th class="font-weight-bold"> Name </th>
                                    <th class="font-weight-bold"> Basic </th>
                                    <th class="font-weight-bold"> House Rent </th>
                                    <th class="font-weight-bold"> Medical </th>
                                    <th class="font-weight-bold"> Special ALW </th>
                                    <th class="font-weight-bold"> Fuel ALW </th>
                                    <th class="font-weight-bold"> Other ALW </th>
                                    <th class="font-weight-bold"> Mobile Bill </th>
                                    <th class="font-weight-bold"> Provident </th>
                                    <th class="font-weight-bold"> Tax Ded. </th>
                                    <th class="font-weight-bold"> Other Ded. </th>
                                    <th class="font-weight-bold"> Total Ded. </th>
                                    <th class="font-weight-bold"> Net Salary </th>
                                    <th class="font-weight-bold"> Gross Salary </th>
                                    <th class="font-weight-bold"> Paid </th>
                                    <th class="font-weight-bold"> Due </th>
{{--                                    <th class="font-weight-bold"> Loan </th>--}}
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($salary_sheets as $i => $salary_sheet)
                                    <tr>
                                        <td>{{ $i+1 ?? '-' }}</td>
                                        <td>{{ $salary_sheet->employee->emp_id ?? '-' }}</td>
                                        <td>{{ $salary_sheet->employee->fname ?? '-' }}</td>
                                        <td>{{ $salary_sheet->basic_salary ?? '-' }}</td>
                                        <td>{{ $salary_sheet->house_rent ?? '-' }}</td>
                                        <td>{{ $salary_sheet->medical ?? '-' }}</td>
                                        <td>{{ $salary_sheet->special_allowance ?? '-' }}</td>
                                        <td>{{ $salary_sheet->fuel_allowance ?? '-' }}</td>
                                        <td>{{ $salary_sheet->phone_bill ?? '-' }}</td>
                                        <td>{{ $salary_sheet->other_allowance ?? '-' }}</td>
                                        <td>{{ $salary_sheet->provident_fund ?? '-' }}</td>
                                        <td>{{ $salary_sheet->tax_deduction ?? '-' }}</td>
                                        <td>{{ $salary_sheet->other_deduction ?? '-' }}</td>
                                        <td>{{ $salary_sheet->total_deduction ?? '-' }}</td>
                                        <td>{{ $salary_sheet->gross_salary ?? '-' }}</td>
                                        <td>{{ $salary_sheet->net_salary ?? '-' }}</td>
                                        <td>{{ $salary_sheet->paid ?? '-' }}</td>
                                        <td>{{ $salary_sheet->Due ?? '-' }}</td>
{{--                                        <td>{{ $salary_sheet->loan ?? '-' }}</td>--}}
                                        <td>    <a href="{{ route('make_payments', $salary_sheet->employee->id) }}">
                                                <i class="far fa-share-square"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <tr class="text-center">
                                        <td colspan="20">
                                            <span class="badge font-weight-bold"
                                            style="background-color: indigo; color: white;">
                                            No Salary Sheet to Show</span>
                                        </td>
                                    </tr>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        // $('#table').css('display','table') ;

        var headingExcel =  '{{ auth()->user()->name }}';
        var headingPrint =  '<h1 id="heading" class="text-center text-dark">{{ auth()->user()->name }}</h1>' +
                            '<h2 class="text-center text-dark">Address, Address, Address</h2>' +
                            '<h4 class="text-center text-dark pt-2">Application List</h4>';
        var headingPDF = '{{ auth()->user()->name }}' + '\n' + '{{ auth()->user()->email }}';

        $('#table').DataTable( {
            responsive: true,
            dom:"<'row '<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'copy',
                    messageTop: '',
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                    title: '',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: 'excel',
                    messageTop: headingExcel,
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                    title: '',
                },
                {
                    extend: 'pdf',
                    title: headingPDF,
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                    title: headingPrint,
                }

            ]
        } );
    } );
</script>
