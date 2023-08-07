<?php

namespace App\Http\Livewire\Adviser;

use Livewire\Component;
use App\Models\Students;
use App\Models\Anecdotal;

class Dashboard extends Component
{
    public $totalStudents;
    public $totalCases;
    public $pendingCases;
    public $resolvedCases;

    protected $listeners = ['refreshCard' => '$refresh'];

    public function mount()
    {
        $this->updateCard();
        $this->startPolling();
    }

    public function startPolling()
    {
        $this->dispatchBrowserEvent('start-polling', [
            'interval' => 5000, // Poll every 5 seconds
        ]);
    }

    public function updateCard()
    {
        $user = auth()->user();
        $classroom = $user->classroom;

        $this->totalStudents = $classroom->students()->count();
        $this->totalCases = $classroom->students->flatMap->anecdotal->count();
        $this->pendingCases = $classroom->students->flatMap->anecdotal->where('case_status', 0)->count();
        $this->resolvedCases = $classroom->students->flatMap->anecdotal->where('case_status', 3)->count();
    }


    public function render()
    {
        return view('livewire.adviser.dashboard')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
    public function updateLiveCard()
    {
        $this->updateCard();
        $this->emit('refreshCard');
    }
}
