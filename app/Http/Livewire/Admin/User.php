<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Component
{
    public $name;
    public $email;
    public $successMessage = '';


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

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|confirmed',
        ]);

        // Verify the current password
        if (!Hash::check($this->currentPassword, auth()->user()->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
            return;
        }

        // Update the password
        $user = auth()->user();
        $user->password = Hash::make($this->newPassword);
        $user->save();

        // Clear the form fields
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->passwordConfirmation = '';
        session()->flash('message', 'Updated Successfully');
    }



}
