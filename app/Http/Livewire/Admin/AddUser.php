<?php

namespace App\Http\Livewire\Admin;

use App\Models\Classroom;
use Livewire\Component;

class AddUser extends Component
{
    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.admin.add-user', compact('classrooms'));
    }
}
