<div>
    {{-- Stop trying to control. --}}


    <div class="card">
        <div class="card-body">
            <label for="month">Month</label>
            <input type="month" name="month" id="month" wire:model="month" class="form-control">
        </div>
    </div>

    <br>
    <br>


    <div class="card">
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-sm " style="width: 100%">
                    <thead>
                    <tr>
                        @php
                            $totalDay = cal_days_in_month(CAL_GREGORIAN, explode('-',$month)[1] ,explode('-',$month)[0]);
                        @endphp
                        <th>Name</th>
                        @for($x = 1; $x <= $totalDay; $x++)
                            <th> <label wire:click="presentAll({{$x}})">
                                <input type="checkbox" name="{{$x}}" id="{{$x}}"

                                    @php
                                        $date =$month.$x;
                                        $day_n = DateTime::createFromFormat('Y-md', $date)->format('D');
                                    @endphp


                                    @foreach($working_days as $days)
                                        @if ($day_n==$days)
                                            disabled
                                        @endif
                                    @endforeach
                                       @php

                                       $holidays = [];
                                       $totalHolidays = \kinetix\payroll\Models\Holiday::all()->where('client_id',auth()->user()->client_id ?? null);
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

                                        @if ($x==$days->format('d'))

                                            disabled
                                        @endif
                                    @endforeach
                                >
                                </label>
                                <br>
                                {{$x}}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_employee as $employee)
                        <tr>

                            <td>{{$employee->fname}}</td>

                            @for($i=1; $i<= $totalDay;$i++)
                                <td>
                                    <label wire:click="present({{$employee->id}} , {{$i}})">
                                        <input type="checkbox" id="{{$i}}"

                                               @php
                                                   $record = json_decode(\kinetix\payroll\Models\Attendance::firstWhere('key',$employee->id.'-'.$month)
                                                                                            ->attendance??'[]') ?? []
                                               @endphp

                                               @foreach($record ?? [] as $e )
                                               @if($i==$e)
                                               checked
                                               @endif

                                               @endforeach

                                               @php
                                                   $date =$month.$i;
                                                   $day_n = DateTime::createFromFormat('Y-md', $date)->format('D');
                                               @endphp


                                               @foreach($working_days as $days)
                                               @if ($day_n==$days)
                                               disabled
                                                @endif
                                                @endforeach


                                            @php

                                                $holidays = [];
                                                $totalHolidays = \kinetix\payroll\Models\Holiday::all()->where('client_id',auth()->user()->client_id ?? null);
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

                                               disabled
                                            @endif
                                            @endforeach
{{--                                             personal leave --}}

                                                    @php
                                                    $leaves = [];
                                                    $total_leave = \kinetix\payroll\Models\Application::all()->where('client_id',auth()->user()->client_id ?? null)
                                                                                                     ->where('employee_id',$employee->id);
                                                    $startOfMonth = Carbon\Carbon::createFromDate($month)->startOfMonth();
                                                    $endOfMonth = Carbon\Carbon::createFromDate($month)->endOfMonth();

                                                    foreach($total_leave as  $leave){
                                                        $date_range = Carbon\CarbonPeriod::create($leave->start,$leave->end)->toArray();
                                                        foreach( $date_range as $date){
                                                            if ($date->between($startOfMonth, $endOfMonth)) {
                                                                array_push($leaves, $date);
                                                            }
                                                        }
                                                    }
                                                     @endphp
                                               @foreach($leaves as $days)

                                               @if ($i==$days->format('d'))

                                               disabled
                                            @endif
                                            @endforeach
                                        >
                                    </label>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
