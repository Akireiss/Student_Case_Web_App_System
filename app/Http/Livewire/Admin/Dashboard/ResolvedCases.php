<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Anecdotal;
use Livewire\Component;

class ResolvedCases extends Component
{

    public $student;

    public function mount(){

    }

    public function render()
    {
        $resolvedCases = Anecdotal::all();
        return view('livewire.admin.dashboard.resolved-cases', [
            'resolvedCases' => $resolvedCases,
        ])->extends('layouts.dashboard.index')->section('content');
    }
}


