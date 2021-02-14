@extends('Payroll::layouts.app-hrm')

@section('content')

    @if (!empty($payslip))
<div class="card" style="color: black">
    <div class="card-body">
        <div id="printSection">
            <div class="text-center mb-2" id="heading">
                <h1>Company Name</h1>
                <h3 class="mb-4">Address</h3>
                <h4>P A Y  S L I P</h4>
                <h6>For the Month of {{$payslip->date ?? " "}}</h6>
            </div>

            <table class="table" style="border: 1px gray; border-style: dashed; color: black">
                <tbody>
                    <tr>
                        <td colspan="2" class="w-50 border border-0" style="border: 1px gray; border-style: dashed;">
                            <table class="table-borderless">
                                <tr>
                                    <td>Emp. ID</td>
                                    <td>:</td>
                                    <td>{{$payslip->employee->emp_id ?? " "}}</td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td>:</td>
                                    <td>{{$payslip->employee->designation->name ?? " "}}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>A/C NO</td>--}}
{{--                                    <td>:</td>--}}
{{--                                    <td>---</td>--}}
{{--                                </tr>--}}
                            </table>
                        </td>
                        <td colspan="2" class="w-50 border border-0">
                            <table  class="table-borderless">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{$payslip->employee->fname ?? " "}}   {{$payslip->employee->lname ?? " "}}</td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td>:</td>
                                    <td>{{$payslip->employee->department->department ?? " "}}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>Designation</td>--}}
{{--                                    <td>:</td>--}}
{{--                                    <td>{{$payslip->employee->designation ?? " "}}</td>--}}
{{--                                </tr>--}}
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Salary & Allowance</td>
                        <td class="font-weight-bold text-right">T A K A</td>
                        <td class="font-weight-bold">Deduction</td>
                        <td class="font-weight-bold text-right">T A K A</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="w-100 table-borderless">
                                <tr>
                                    <td class=" border border-0">Basic Salary</td>
                                    <td class="text-right  border border-0">{{$payslip->basic_salary}}</td>
                                </tr>
                                <tr>
                                    <td >House Rent</td>
                                    <td class="text-right">{{$payslip->house_rent}}</td>
                                </tr>
                                <tr>
                                    <td >Medical Allowance</td>
                                    <td class="text-right">{{$payslip->medical}}</td>
                                </tr>
                                <tr>
                                    <td >Fuel Allowance</td>
                                    <td class="text-right">{{$payslip->fuel_allowance}}</td>
                                </tr>
                                <tr>
                                    <td >Special Allowance</td>
                                    <td class="text-right">{{$payslip->special_allowance}}</td>
                                </tr>
                                <tr>
                                    <td >Other Allowance</td>
                                    <td class="text-right">{{$payslip->other_allowance}}</td>
                                </tr>
                                <tr>
                                    <td >Mobile Bill</td>
                                    <td class="text-right">{{$payslip->phone_bill}}</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2">
                            <table class="w-100 table-borderless">
                                <tr>
                                    <td >Provident</td>
                                    <td class="text-right">{{$payslip->provident_fund}}</td>
                                </tr>
                                <tr>
                                    <td >Tax Deduction</td>
                                    <td class="text-right">{{$payslip->tax_deduction}}</td>
                                </tr>
                                <tr>
                                    <td >Other Deduction</td>
                                    <td class="text-right">{{$payslip->other_deduction}}</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Gross Salary</td>
                        <td class="font-weight-bold text-right">{{$payslip->gross_salary}}</td>
                        <td class="font-weight-bold">Total Deduction</td>
                        <td class="font-weight-bold text-right">{{$payslip->total_deduction}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">
                            NET SALARY : TK. {{$payslip->net_salary}}
                            @if($payslip->Due >0)
                            <br> <br> Paid : TK. {{$payslip->paid}}
                            <br> <br> Due : TK. {{$payslip->Due}}
                                @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center pt-5">
    <button onclick="makePDF('printSection')" class="btn btn-success">Print</button>
</div>
    @else
        <img src="https://pansari.pk/images/NoRecordFound.jpg" alt=""  width="100%">
    @endif


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
