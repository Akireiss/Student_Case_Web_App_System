<?php

namespace App\Http\Livewire\Admin\Offenses;

use App\Models\Offenses;
use Livewire\Component;

class EditOffense extends Component
{
    public $offenses;
    public $description;
    public $status;
    public $offense;
    public $category;



    public function mount($offense)
    {
        $this->offense = $offense;
        $offense = Offenses::findOrFail($offense);
        $this->offenses = $offense->offenses;
        $this->description = $offense->description;
        $this->status = $offense->status;
        $this->category = $offense->category;

    }
    public function render()
    {
        return view('livewire.admin.offenses.edit-offense', [
            'offense' => $this->offense,
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
    public function update()
    {
        $this->validate([
            'offenses' => 'required',
            'description' => 'required',
            'status' => 'required|in:0,1',
        ]);
        $offense = Offenses::findOrFail($this->offense);
        $offense->update([
            'offenses' => $this->offenses,
            'description' => $this->description,
            'status' => $this->status,
            'category' => $this->category,
        ]);

        session()->flash('message', 'Updated successfully.');
    }


}
