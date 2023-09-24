<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Component
{
    public $name;
    public $email;
    public $currentPassword;
    public $newPassword;
    public $passwordConfirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
        ]);

        $user = Auth::user();
        $user->update($validatedData);


        session()->flash('message', 'Updated Successfully');
    }

    public function render()
    {
        return view('livewire.admin.user')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    protected $rules = [
        'currentPassword' => 'required',
        'newPassword' => 'required|min:8',
    ];

    public function updatePassword()
    {
        $this->validate();

        if (!Hash::check($this->currentPassword, auth()->user()->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
            return;
        }

        auth()->user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->reset(['currentPassword', 'newPassword', 'passwordConfirmation']);

        session()->flash('success', 'Password updated successfully.');
    }

}
