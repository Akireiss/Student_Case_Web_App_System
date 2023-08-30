<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $classroom_id;
    public $status;
    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.admin.add-user', compact('classrooms'))
        ->extends('layouts.dashboard.index')
        ->section('content');
    }

    public function store()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:0,1',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create([
            'name' =>$this->name,
            'email' =>$this->email,
            'password' =>$this->password,
            'role' =>$this->role,
            'classroom_id' =>$this->classroom_id,
            'status' =>$this->status
        ]);
        session()->flash('message', 'Successfully Added');
        $this->resetForm();
    }

    public function resetForm() {
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->role = "";
        $this->classroom_id = null;
        $this->status = "";
    }

}
