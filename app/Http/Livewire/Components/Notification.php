<?php

namespace App\Http\Livewire\Components;

use App\Models\Report;
use Livewire\Component;

class Notification extends Component
{

    public $reports;
    public $pollInterval = 3000;


    public function mount()
    {
        $this->fetchReports();
    }


    public function fetchReports()
    {
        $this->reports = Report::whereHas('anecdotal', function ($query) {
            $query->whereIn('case_status', [1, 2]);
        })->where('user_id', auth()->id())
          ->latest('created_at')
          ->get();
    }




    public function updated()
    {
        $this->dispatchBrowserEvent('refreshComponent', ['interval' => $this->pollInterval]);
    }


}








