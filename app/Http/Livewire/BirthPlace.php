<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;

class BirthPlace extends Component
{
    public $selectedProvinceBirth;
    public $selectedMunicipalityBirth;
    public $selectedBarangayBirth;
    public $municipalitiesBirth = [];
    public $barangaysBirth = [];

    public function render()
    {
        $provinces = Province::all();
        $municipalities = Municipal::where('province_id', $this->selectedProvinceBirth)->get();
        $barangays = Barangay::where('municipal_id', $this->selectedMunicipalityBirth)->get();

        return view('livewire.birth-place', compact('provinces', 'municipalities', 'barangays'));
    }

    public function updatedSelectedProvinceBirth($provinceId)
    {
        $this->municipalitiesBirth = Municipal::where('province_id', $provinceId)->get();
        $this->selectedMunicipalityBirth = null;
        $this->selectedBarangayBirth = null;
        $this->barangaysBirth = [];
    }

    public function updatedSelectedMunicipalityBirth($municipalityId)
    {
        $this->barangaysBirth = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangayBirth = null;
    }
}
