<?php

namespace App\Http\Livewire\Adviser;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.adviser.dashboard')
        ->extends('layouts.dashboard.index')
        ->section('content');
    }
}
