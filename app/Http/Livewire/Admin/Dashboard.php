<?php

namespace App\Http\Livewire\Admin;

use App\Models\Anecdotal;
use App\Models\Students;
use Livewire\Component;

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
        $this->totalStudents = Students::count();
        $this->totalCases = Anecdotal::count();
        $this->pendingCases = Anecdotal::where('case_status', 0)->count();
        $this->resolvedCases = Anecdotal::where('case_status', 3)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
    public function updateLiveCard()
    {
        $this->updateCard();
        $this->emit('refreshCard');
    }
}
