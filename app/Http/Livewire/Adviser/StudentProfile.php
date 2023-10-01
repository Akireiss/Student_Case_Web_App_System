<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Profile;
use Livewire\Component;
use App\Models\Anecdotal;
use Illuminate\Support\Facades\Auth;

class StudentProfile extends Component
{
    public function render()
    {
        return view('livewire.adviser.student-profile')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }


    public function show($id)
    {
        $user = Auth::user();
        $profile = $user->students->flatMap->profile->firstWhere('id', $id);
        if (!$profile) {
          abort (403);
        }
        return view('staff.profile.view', compact('profile'));
    }


}
