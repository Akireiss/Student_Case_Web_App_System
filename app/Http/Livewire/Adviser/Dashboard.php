<?php

namespace App\Http\Livewire\Adviser;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Students;
use App\Models\Anecdotal;

class Dashboard extends Component
{
    public $totalStudents;
    public $totalCases;
    public $pendingCases;
    public $resolvedCases;
    public $dailyReportCount;
    public $lastUpdatedDay;
    public $weeklyReportCount;

    public $lastUpdatedWeek;




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



    public function resetDailyReportCount()
    {
        $this->dailyReportCount = 0;
    }

    public function resetWeeklyReportCount()
    {
        $this->weeklyReportCount = 0;
    }


    public function updateCard()
    {
        $user = auth()->user();
        $classroom = $user->classroom;

        $today = Carbon::now()->format('Y-m-d');
        //Week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Reset daily report count if it's a new day
        if ($today != $this->lastUpdatedDay) {
            $this->resetDailyReportCount();
            $this->lastUpdatedDay = $today;
        }

        if (!$this->lastUpdatedWeek || !$startOfWeek->isSameWeek($this->lastUpdatedWeek)) {
            $this->resetWeeklyReportCount();
            $this->lastUpdatedWeek = $startOfWeek;
        }


        $this->totalStudents = $classroom?->students?->count();
        $this->totalCases = $classroom?->students?->flatMap->anecdotal->count();
        $this->pendingCases = $classroom?->students?->flatMap->anecdotal->where('case_status', 0)->count();
        $this->resolvedCases = $classroom?->students?->flatMap->anecdotal->where('case_status', 3)->count();

        // Counting cases for the day
        $this->dailyReportCount = $classroom?->students?->flatMap->anecdotal
            ->where('created_at', '>=', $today)
            ->count();

        $this->weeklyReportCount = $classroom?->students?->flatMap->anecdotal
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
    }


    public function render()
    {
        return view('livewire.adviser.dashboard', [
            'dailyReportCount' => $this->dailyReportCount,
            'weeklyReportCount' => $this->weeklyReportCount,
        ])->extends('layouts.dashboard.index')->section('content');
    }

    public function updateLiveCard()
    {
        $this->updateCard();
        $this->emit('refreshCard');
    }
}
