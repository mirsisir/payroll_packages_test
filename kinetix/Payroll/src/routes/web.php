<?php

use kinetix\payroll\Http\Livewire\Department\Crud;
use livw\Test\Http\Controller\TestController;
use kinetix\payroll\Http\Livewire\LiveTestComponent;

//Route::get('content',function(){
//   return view('live::test');
//});
//

//Route::get('department1',function(){
//   return view('Payroll::index');
//});



//
//Route::get('/hello',[ TestController::class,'index'])->name('hello');
//
Route::get('/live', LiveTestComponent::class)->name('sisir.test');

Route::get('/department', Crud::class)->name('Payroll.live');

//
