<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;

class UserUpdate extends Component
{
    public $user;
    public $userEmail;
    public $userPassword;
    public $role;
    public $userName;
    public $status;
    public $classroom_id;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->userEmail = $this->user->email;
        $this->status = $this->user->status;
        $this->userName = $this->user->name;
        $this->role = $this->user->role;
        $this->userPassword = $this->user->password = "";
        $this->classroom_id = $this->user->classroom_id;
    }
    public function render()
    {
        $classrooms = Classroom::where('status', 0)->get();
        return view('livewire.admin.user.user-update',
        compact('classrooms'))->extends('layouts.dashboard.index')->section('content');
    }
    public function updateUser()
    {
        $this->validate([
            'userEmail' => 'required|email',
            'role' => 'required',
            'userName' => 'required',
            'status' => 'required',
            'userPassword' => 'nullable|min:8',
        ]);

        $data = [
            'email' => $this->userEmail,
            'role' => $this->role,
            'name' => $this->userName,
            'status' => $this->status,
            'classroom_id' => $this->classroom_id
        ];

        if (!empty($this->userPassword)) {
            $data['password'] = bcrypt($this->userPassword);
        }

        $this->user->update($data);

        session()->flash('message', 'User information updated successfully.');

    }

}
