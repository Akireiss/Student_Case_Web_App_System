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

        // Emit an event named 'birthDataUpdated' and pass the selected province ID and province data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $provinceId,
            'provinceData' => Province::find($provinceId),
            'municipalityId' => $this->selectedMunicipalityBirth, // Pass the selected municipality ID
            'barangayId' => $this->selectedBarangayBirth, // Pass the selected barangay ID
        ]);
    }

    public function updatedSelectedMunicipalityBirth($municipalityId)
    {
        $this->barangaysBirth = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangayBirth = null;

        // Emit an event named 'birthDataUpdated' and pass the selected municipality ID and municipality data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $this->selectedProvinceBirth, // Pass the selected province ID
            'provinceData' => Province::find($this->selectedProvinceBirth), // Pass the selected province data
            'municipalityId' => $municipalityId,
            'municipalityData' => Municipal::find($municipalityId),
            'barangayId' => $this->selectedBarangayBirth, // Pass the selected barangay ID
        ]);
    }

    public function updatedSelectedBarangayBirth($barangayId)
    {
        // Emit an event named 'birthDataUpdated' and pass the selected barangay ID and barangay data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $this->selectedProvinceBirth, // Pass the selected province ID
            'provinceData' => Province::find($this->selectedProvinceBirth), // Pass the selected province data
            'municipalityId' => $this->selectedMunicipalityBirth, // Pass the selected municipality ID
            'municipalityData' => Municipal::find($this->selectedMunicipalityBirth), // Pass the selected municipality data
            'barangayId' => $barangayId,
            'barangayData' => Barangay::find($barangayId),
        ]);
    }
}
