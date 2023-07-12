<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StudentsProfile extends Component
{
    public function render()
    {
        return view('livewire.admin.students-profile')
        ->extends('layouts.dashboard.index')
        ->section('content');
    }
}
