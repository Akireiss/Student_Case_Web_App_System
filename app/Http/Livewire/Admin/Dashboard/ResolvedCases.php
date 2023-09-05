<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class ResolvedCases extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.resolved-cases')
        ->extends('layouts.dashboard.index')->section('content');
    }
}


