<?php

namespace kinetix\payroll\Http\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Payroll::home');
    }

//        public function employee_create()
//    {
//        return view('Payroll::employees.create');
//
//    }


}
