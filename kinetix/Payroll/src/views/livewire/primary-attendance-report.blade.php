<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3 m-auto">
                    <select name="employee" wire:model="department" id="department" class="form-control">
                        <option value="">Select Department</option>
                        @foreach($all_department as $record)
                            <option value="{{$record->id}}">{{$record->department }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3 m-auto">
                    <input type="month" wire:model="month" class="form-control"/>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if($department)
    <div class="card printableArea">
        <div class="card-body" id="printSection">
            <div class=" m-auto" style="width: 90%">
                <h2 class="text-center">Company Name</h2>
                <p class="text-center">Company address</p>
                <p class="text-center">phone</p>
                <table class="table table-bordered">
                    <tbody>
                    <tr class="font-weight-bold">
                        <td>Month : {{$month}} </td>
                        <td>Total Day : {{$day_count_month}} </td>
                        <td>Total OffDay : {{$total_offday}}</td>
                        <td>Total Holiday : {{$holidays}}</td>
                        <td>Total Working Day : {{$day_count_month-($total_offday+$holidays)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-hover border">
                    <thead>
                    <tr class="font-weight-bold btn-info">
                        <th> Employee</th>
                        <th> Leave</th>
                        <th> Present</th>
                        <th> Absent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($all_employee as $employee)
                        @php
                                $key = $employee->id."-".$month;
                            $record= \kinetix\payroll\Models\Attendance::firstWhere('key',$key);
                            $attendance = json_decode(optional($record)->attendance , true )?? [] ;
                            $total_p = count($attendance);


                            $leaves = [];


                                $total_leave = \kinetix\payroll\Models\Application::Where('employee_id',$employee->id)->get();
                                $startOfMonth = \Carbon\Carbon::createFromDate($month)->startOfMonth();
                                $endOfMonth = \Carbon\Carbon::createFromDate($month)->endOfMonth();

                                foreach ($total_leave as $holiday) {

                                    $dateRange = \Carbon\CarbonPeriod::create($holiday->start, $holiday->end)->toArray();
                                    foreach ($dateRange as $date) {
                                        if ($date->between($startOfMonth, $endOfMonth)) {
                                            array_push($leaves, $date);
                                        }
                                    }

                                }
                               $total_l = count($leaves);

                        @endphp
                        <tr>
                            <td>{{$employee->fname}} {{$employee->lname}}</td>
                            <td>{{$total_l}}</td>
                            <td>{{$total_p}}</td>
                            <td>{{$day_count_month-($total_p+$total_offday+$holidays+$total_l)}}</td>
                        </tr>
                    @empty
                        <p>N/A</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @if($department)

    @endif
    <a href="javascript:void(0);" id="printButton" class = " btn btn-success float-right mr-5">Print</a>




</div>

@section('js')
    <script>

        $(document).ready(function(){
            $("#printButton").click(function(){
                // var mode = 'iframe'; //popup
                // var close = mode == "popup";
                // var options = { mode : mode, popClose : close};
                // $("div.printableArea").printArea( options );
                var prtContent = document.getElementById("printSection");
                var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                var htm = '<link media="all" type="text/css" rel="stylesheet" href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/css/app.css">';

                WinPrint.document.write(htm+prtContent.innerHTML);
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
            });
        });



    </script>
@endsection
