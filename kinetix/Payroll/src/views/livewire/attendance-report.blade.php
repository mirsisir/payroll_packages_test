<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card">
        <div class="card-body border">
            <form action="">
                <div class="row m-auto">
                    <div class="col-3 m-auto">
                        <select name="employee" wire:model="employee" id="employee" class="form-control">
                            <option value="">Select Employee</option>
                            @foreach($all_employee as $record)
                                <option value="{{$record->id}}">{{$record->fname }} {{$record->lname}} </option>
                            @endforeach
                        </select>
                    </div>

{{--                    <div class="col-3 m-auto">--}}
{{--                        <select name="employee" wire:model="department" id="department" class="form-control">--}}
{{--                            <option value="">Select Department</option>--}}
{{--                            @foreach($all_department as $record)--}}
{{--                                <option value="{{$record->id}}">{{$record->department }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-3 m-auto">--}}
{{--                        <select name="employee" wire:model="designation" id="designation" class="form-control">--}}
{{--                            <option value="">Select Designation</option>--}}
{{--                            @foreach($all_designation as $record)--}}
{{--                                <option value="{{$record->id}}">{{$record->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

                                        <div class="col-3 m-auto">
                                            <input type="number" min="1900" max="2099" step="1" value="2020" class="form-control" />
                                        </div>

                </div>
            </form>

        </div>
    </div>
    <br>
    <br>
    @if($employee)
        <div class="card">
            <div class="card-body">

                @foreach($employee_a_record as $record)

                    @php $attendance = json_decode(optional($record)->attendance, true  ) ?? [] ;$total = count($attendance);

                    $month =explode("-", $record->month)[1];
                    $year =explode("-", $record->month)[0];
                  $day_count_month = cal_days_in_month(CAL_GREGORIAN,$month ,$year);

                 function dayCount($day, $month, $year)
                        {
                            $totalDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            $count = 0;
                            for ($i = 1; $totalDay >= $i; $i++) {

                                if (date('l', strtotime($year . '-' . $month . '-' . $i)) == ucwords($day)) {
                                    $count++;
                                }
                            }
                            return $count;
                        }

                //        working day count ----------------------------------
                        $holiday_days = [];
                        $total_offday = 0;

                        $workingday = kinetix\payroll\Models\WorkingDay::firstWhere('client_id',auth()->user()->client_id ?? null);
                        if ($workingday->sat == 0) {
                            array_push($holiday_days, 'Saturday');
                        }
                        if ($workingday->sun == 0) {
                            array_push($holiday_days, 'Sunday');
                        }
                        if ($workingday->mon == 0) {
                            array_push($holiday_days, 'Monday');
                        }
                        if ($workingday->tue == 0) {
                            array_push($holiday_days, 'Tuesday');
                        }
                        if ($workingday->wed == 0) {
                            array_push($holiday_days, 'Wednesday');
                        }
                        if ($workingday->thu == 0) {
                            array_push($holiday_days, 'Thursday');
                        }
                        if ($workingday->fri == 0) {
                            array_push($holiday_days, 'friday');
                        }


                        foreach ($holiday_days as $day) {
                            $total_offday += dayCount($day, $month, $year);

                        }
                        //  holiday
                        $holidays = [];
                    $totalHolidays = kinetix\payroll\Models\Holiday::all();
                    $startOfMonth = Carbon\Carbon::createFromDate($record->month)->startOfMonth();
                    $endOfMonth = Carbon\Carbon::createFromDate($record->month)->endOfMonth();


                    foreach ($totalHolidays as $holiday) {

                        $dateRange = Carbon\CarbonPeriod::create($holiday->start, $holiday->end)->toArray();

                        foreach ($dateRange as $date) {

                            if ($date->between($startOfMonth, $endOfMonth)) {

                                array_push($holidays, $date);
                            }

                        }

                    }

                    @endphp

                    <div class=" m-auto" style="width: 90%">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Month : {{$record->month}}</td>
                                <td>Total Day : {{$day_count_month}}</td>
                                <td>Total OffDay : {{$total_offday}} </td>
                                <td>Total Holiday : {{count($holidays)}}</td>
                                <td>Total Working Day : {{$day_count_month- ($total_offday+ count($holidays)) }}</td>
                                <td>Total Present : {{$total}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


</div>
