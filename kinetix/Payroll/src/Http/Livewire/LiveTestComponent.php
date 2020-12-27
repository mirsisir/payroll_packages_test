<?php

namespace kinetix\payroll\Http\Livewire;

use Livewire\Component;

class LiveTestComponent extends Component
{
    public function render()
    {
        return view('live::livewire.live-test-component')->layout('layouts.admin.base');
    }
}
