<?php

namespace App\Http\Livewire;

use App\Models\Barangay;
use App\Models\City;
use App\Models\Municipal;
use Livewire\Component;

class BirthPlace extends Component
{
    public $selectedCityBirth;
    public $selectedMunicipalityBirth;
    public $selectedBarangayBirth;
    public $municipalitiesBirth = [];
    public $barangaysBirth = [];

    public function render()
    {
        $cities = City::all();
        $municipalities = Municipal::where('city_id', $this->selectedCityBirth)->get();
        $barangays = Barangay::where('municipal_id', $this->selectedMunicipalityBirth)->get();

        return view('livewire.birth-place', compact('cities', 'municipalities', 'barangays'));
    }

    public function updatedSelectedCityBirth($cityId)
    {
        $this->municipalitiesBirth = Municipal::where('city_id', $cityId)->get();
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
