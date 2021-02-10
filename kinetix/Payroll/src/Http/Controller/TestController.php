<?php

namespace kinetix\payroll\Http\Controller;

use kinetix\payroll\Http\Controller\Controller;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index(){

        return view('live::test');
    }
}
