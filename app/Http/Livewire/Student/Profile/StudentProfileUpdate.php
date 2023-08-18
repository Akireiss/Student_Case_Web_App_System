<?php

namespace App\Http\Livewire\Student\Profile;

use App\Models\Profile;
use Livewire\Component;

class StudentProfileUpdate extends Component
{
    public $profileId;
    public $profile;
    public $parentStatuses = [];
    public function mount($profile)
    {
        $this->profileId = $profile;
        $this->profile = Profile::findOrFail($profile);
        $this->parentStatuses = $this->profile->parent_status->pluck('parent_status')->toArray();
    }


    public function render()
    {
        return view('livewire.student.profile.student-profile-update', [
            'profile' => $this->profile
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
}
