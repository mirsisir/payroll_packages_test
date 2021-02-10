<?php

namespace kinetix\payroll\Http\Controller\Master;

use kinetix\payroll\Http\Controller\Controller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
  public function index(){
      return view('master.index');
  }
}
