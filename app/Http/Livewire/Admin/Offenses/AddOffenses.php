<?php

namespace App\Http\Livewire\Admin\Offenses;

use App\Models\Offenses;
use Livewire\Component;

class AddOffenses extends Component
{
    public $offenses;
    public $description;
    public $status;
    public $offense;
    public $category;

    public function render()
    {
        return view('livewire.admin.offenses.add-offenses')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function create()
    {
        $this->validate([
            'offenses' => 'required|string',
            'category' => 'required',
            'status' => 'required|in:0,1',
            'description' => 'required|string',
        ]);

        // Save the offense to the database
        Offenses::create([
            'offenses' => $this->offenses,
            'category' => $this->category,
            'status' => $this->status,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Offense created successfully');
        $this->resetForm();
    }
    private function resetForm()
    {
        $this->reset([
            'offenses',
            'category',
            'status',
            'description',
            // Add other properties you want to reset
        ]);
    }
}
