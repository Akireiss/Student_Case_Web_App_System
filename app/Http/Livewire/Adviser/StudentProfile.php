<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Anecdotal;
use Livewire\Component;

class StudentProfile extends Component
{
    public function render()
    {
        $anecdotals = Anecdotal::all();
        return view('livewire.adviser.student-profile', [
            'anecdotals' => $anecdotals, // Fix the array key syntax here
        ])
        ->extends('layouts.dashboard.index')
        ->section('content');
    }

}
