<?php

namespace kinetix\payroll;




use Illuminate\Support\ServiceProvider;
use kinetix\payroll\Http\Livewire\Department\Crud;
use Livewire\Livewire;
use kinetix\payroll\Http\Livewire\LiveTestComponent;

class HRMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
//        Livewire::component('acc::voucher-entry-component', VoucherEntryComponent::class);


        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'Payroll');


        Livewire::component('sisir::live-test-component', LiveTestComponent::class);

        Livewire::component('Payroll::crud', Crud::class);


    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
