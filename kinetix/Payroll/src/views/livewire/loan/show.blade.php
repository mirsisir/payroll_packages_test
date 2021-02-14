@extends('Payroll::layouts.app-hrm')

@section('content')

<div class="card" style="color: black">
    <div class="card-body">
        <div id="printSection">
            <div class="text-center mb-4" id="heading">
                <h1>Loan Report</h1>
                <table class="d-flex justify-content-center" style="color: black">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>:</td>
                            <td class="pl-3">{{ $loan->employee->fname ?? ''  }}</td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td class="pl-3">{{ $loan->employee->emp_id ?? ''  }}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>:</td>
                            <td class="pl-3">{{ $loan->employee->department ?? ''  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <table class="table table-bordered table-hover" style="color: black">
                    <thead>
                        <tr class="bg-secondary" style="color: black">
                            <th class="font-weight-bold">Date</th>
                            <th class="font-weight-bold">Amount</th>
                            <th class="font-weight-bold">Repayment</th>
                            <th class="font-weight-bold">Installment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($loan->approve_date)) }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->repay_total }}</td>
                            <td>{{ $loan->installment }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-3">
                <span class="font-weight-bold">Notes:</span> {{ $loan->note }}
            </div>
        </div>
    </div>
</div>

<div class="text-center pt-5">
    <button onclick="makePDF('printSection')" class="btn btn-success">Print</button>
</div>

<script>
    function makePDF(printSection) {
        var head = document.getElementById("heading");
        head.style.display = "block";
        head.style.color = "black";
        // var document.getElementById(printSection).style.color = "black";
        var printContents = document.getElementById(printSection).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

@endsection
