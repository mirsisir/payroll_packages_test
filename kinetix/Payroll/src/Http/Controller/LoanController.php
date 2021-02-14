<?php

namespace kinetix\payroll\Http\Controller;

use kinetix\payroll\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function show(Loan $loan)
    {
        return view('Payroll::livewire.loan.show', compact('loan'));
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect('Payroll::loans')->with('danger', 'Loan Deleted Successfully');
    }
}
