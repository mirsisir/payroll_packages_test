<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}


    <div class="card">
        <div class="card-body">
            {{--            <h4 class="card-title">Salary Info</h4>--}}

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="btn-success">
                    <tr>
                        <th> <p class="badge-pill badge-secondary badge">Salary Info</p> </th>
                        <th> Employee name</th>
                        <th> ID</th>
                        <th> Basic salary</th>
                        <th> Total Deduction</th>
                        <th> Gross Salary</th>
                        <th> Net Salary</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><img src="/storage/{{ $employee->photo ?? "N/A"}}" width="40" height="30" alt=""></td>

                        <td> {{$employee->fname}} {{ " " }} {{$employee->lname}} <br> {{$employee->mobile}} </td>
                        <td> {{$employee->emp_id ?? "N/A"}} <br> {{$employee->salaryInfo->employee_type ?? "N/A"}} </td>
                        <td> {{$employee->salaryInfo->basic_salary ?? "N/A"}}</td>
                        <td> {{$employee->salaryInfo->total_deduction ?? "N/A"}}</td>
                        <td> {{$employee->salaryInfo->gross_salary ?? "N/A"}}</td>
                        <td> {{$net_salary ?? "N/A"}}</td>


                    </tr>

                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="form-sample">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Select Month</label>
                            <div class="col-sm-9"><input type="month" wire:model="select_month" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Payments Amount</label>
                            <div class="col-sm-9"><input type="number" wire:model="Payment_amount"  class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Payments Type</label>
                            <div class="col-sm-9">
                                <select name="payment_type" wire:model="payment_type" id="payment_type"
                                        class="form-control">
                                    <option>Select Payments Type</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank Account</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Loan Deduction</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="loan" class="form-control"></div>
                        </div>
                    </div>
                </div>


                <div class=" m-auto" style="width: 100%" >
                    <input id="auto_cal" type="checkbox" name="auto" wire:click="calculate" id="">
                    <label for="auto_cal"> Calculate Fine</label>
                    <table class="table table-bordered">

                        <tbody>
                        <tr>
                            <td>Total Day : {{$day_count_month}}</td>
                            <td>Total Off Day : {{$total_offday}}</td>
                            <td>Working Day : {{$total_working_day}}</td>
                            <td>Total Absent : {{$total_absent}}</td>
                            <td style="width: 20%">Fine Each Day : <input type="number"  style="width: 35%" wire:model="fine_each_day" ></td>
                            <td style="width: 20%"> Total Fine : {{$total_fine_by_date}}</td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <br>




                @php

                    $record = kinetix\payroll\Models\SalarySheet::firstWhere( 'employee_id',$this->iid);

                @endphp

                 @if ($record->Due > 0 || $record->Due ==  null )
                <button wire:click="make_payments" class="float-right mr-0 btn btn-outline-success "> Make Payments Record</button>
                     @else
                    <a class="float-right mr-0 btn btn-outline-success" href="/payslip/{{ $record->employee_id.'/'.($record->date) }}">Payslip</a>
                @endif

            </div>
        </div>
    </div>

</div>
