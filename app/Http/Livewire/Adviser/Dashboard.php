<?php

namespace App\Http\Livewire\Adviser;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Students;
use App\Models\Anecdotal;
use Carbon\CarbonTimeZone;

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

        $currentTime = Carbon::now(new CarbonTimeZone('Asia/Manila'));
        $today = $currentTime->format('Y-m-d');

        $startOfWeek = Carbon::now(new CarbonTimeZone('Asia/Manila'))->startOfWeek();
        $endOfWeek = Carbon::now(new CarbonTimeZone('Asia/Manila'))->endOfWeek();

        if ($currentTime->hour == 7 && $currentTime->minute >= 25) {
            $this->resetDailyReportCount();
        }

        // Reset weekly report
        if ($currentTime->isMonday()) {
            $this->resetWeeklyReportCount();
        }

        if (Carbon::now()->format('H:i') === '00:00') {
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
