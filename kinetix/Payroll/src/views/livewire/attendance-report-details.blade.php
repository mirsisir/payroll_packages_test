<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3 m-auto">
                    <select name="employee" wire:model="employee" id="department" class="form-control">
                        <option value="">Select Employee</option>
                        @foreach($all_employee as $employee)
                            <option value="{{$employee->id}}">{{$employee->fname }} {{$employee->lname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3 m-auto">
                    <input type="month" wire:model="month" class="form-control"/>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    @php
        $total_day = cal_days_in_month(CAL_GREGORIAN, explode('-',$month)[1] ,explode('-',$month)[0]);

    @endphp
    <div class="card">
        <table class="m-auto">
            <tr>
                <td>.</td>
            </tr>
            <tr class="mt-3">
                <td class="font-weight-bold"> Present : <i class="fas fa-stop" style="color: #20c997;"></i></td>
                <td class="font-weight-bold"> Holiday : <i class="fas fa-stop" style="color: #ef114e;"></i></td>
                <td class="font-weight-bold"> Off Day : <i class="fas fa-stop" style="color: #a8b1a8;"></i></td>
            </tr>
        </table>
        <div class="card-body" id="printSection">

            <table class="table table-bordered table-sm " style="width: 100%">
                <thead>
                <tr class="btn-info">
                    <th scope="col">Employee Name</th>
                    @for($i=1; $i<= $total_day;$i++)
                        <th>{{$i}}</th>
                    @endfor

                </tr>
                <tr>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($all_employee as $employee)
                    <tr class="mb-1">
                        @php
                            $record = json_decode(\kinetix\payroll\Models\Attendance::firstWhere('key',$employee->id.'-'.$month)->attendance??'[]') ?? []
                        @endphp

                        <td scope="row">{{$employee->fname}}</td>


                        @for($i=1 ; $i<=$total_day ; $i++)
                            @php
                                $record = json_decode(\kinetix\payroll\Models\Attendance::firstWhere('key',$employee->id.'-'.$month)->attendance??'[]') ?? []
                            @endphp

                            <td class="mb-1
                            @php
                                $record = json_decode(\kinetix\payroll\Models\Attendance::firstWhere('key',$employee->id.'-'.$month)
                                                                         ->attendance??'[]') ?? []
                            @endphp

                            @foreach($record ?? [] as $e )
                            @if($i==$e)
                                btn-success
                            @endif

                            @endforeach
                            @php
                                $date =$month.$i;
                                $day_n = DateTime::createFromFormat('Y-md', $date)->format('D');


                                $holidays = [];
                                $totalHolidays = \kinetix\payroll\Models\Holiday::all();
                                $startOfMonth = Carbon\Carbon::createFromDate($month)->startOfMonth();
                                $endOfMonth = Carbon\Carbon::createFromDate($month)->endOfMonth();

                                foreach ($totalHolidays as $holiday) {

                                    $dateRange = Carbon\CarbonPeriod::create($holiday->start, $holiday->end)->toArray();
                                    foreach ($dateRange as $date) {
                                        if ($date->between($startOfMonth, $endOfMonth)) {
                                            array_push($holidays, $date);
                                        }
                                    }

                                }
                            @endphp
                            @foreach($holidays as $days)

                            @if ($i==$days->format('d'))

                                btn-danger
@endif
                            @endforeach


                            @foreach($working_days as $days)
                            @if ($day_n==$days)
                                btn-secondary
                          @endif
                            @endforeach
                                ">


                            </td>

                        @endfor

                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>

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
                var htm = '' +
                    '<link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/materialicons.css') }}">' +
                    '<link media="all" type="text/css" rel="stylesheet" href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/css/app.css">';

                WinPrint.document.write(htm+prtContent.innerHTML);
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
            });
        });


        $(document).ready(function () {
            // alert('lsdf')
            $('.btn-success').append('<i class="mdi mdi-check"></i>');
            $('.btn-danger').append('<i class="mdi mdi-crosshairs"></i>');
            $('.btn-secondary').append('<i class="mdi mdi-home"></i>');
        })
    </script>
@endsection
