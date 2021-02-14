<?php

namespace kinetix\payroll\Http\Controller;

use kinetix\payroll\Models\WorkingDay;
use Illuminate\Http\Request;

class WorkingDaysController extends Controller
{
    public function index()
    {
        $working_days = WorkingDay::take(1)->first();

        if(! $working_days)
        {
            $working_days = new WorkingDay();
        }

        return view('Payroll::working-days', compact('working_days'));
    }

    public function store(Request $request)
    {
        $sat = $request->sat == 'on' ? 1 : 0;
        $sun = $request->sun == 'on' ? 1 : 0;
        $mon = $request->mon == 'on' ? 1 : 0;
        $tue = $request->tue == 'on' ? 1 : 0;
        $wed = $request->wed == 'on' ? 1 : 0;
        $thu = $request->thu == 'on' ? 1 : 0;
        $fri = $request->fri == 'on' ? 1 : 0;

        WorkingDay::updateOrCreate(
        ['client_id' => auth()->user()->client_id ??null],
        [
            'user_id' => auth()->user()->id,
            'sat' => $sat,
            'sun' => $sun,
            'mon' => $mon,
            'tue' => $tue,
            'wed' => $wed,
            'thu' => $thu,
            'fri' => $fri
        ]);

        return redirect('set-working-days')->with('success', 'Working Days Has Been Updated!');
    }

}
