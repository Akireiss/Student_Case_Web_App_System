<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Report extends Component
{
    public function render()
    {
        return view('livewire.admin.report')
        ->extends('layouts.dashboard.index')
        ->section('content');
    }
}
