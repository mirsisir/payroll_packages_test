<?php

namespace kinetix\payroll\Http\Controller;

use kinetix\payroll\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{


    public function store(Request $request)
    {
        $data = $request->validate([
            'event_name' => 'required',
            'description' => 'required|min:3',
            'start' => 'required',
            'end' => 'required',
        ]);

        auth()->user()->holidays()->create($data);

        return redirect('/holidays')->with('success', 'Holidays successfully Inserted.');
    }

    public function edit(Request $request, Holiday $holiday)
    {
        return view('/holidays/edit', compact('holiday'));
    }





    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->validate([
            'event_name' => 'required',
            'description' => 'required|min:3',
            'start' => 'required',
            'end' => 'required',
        ]);

        $holiday->update($data);
        return redirect('/holidays')->with('success', 'Holidays successfully Updated.');
    }

}
