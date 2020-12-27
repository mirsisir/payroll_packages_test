<?php

namespace livw\Test\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index(){

        return view('live::test');
    }
}
