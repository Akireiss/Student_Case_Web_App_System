<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Municipal;

class StudentsProfile extends Component

{

    public $selectedCity;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = []; // Initialize as empty array
    public $barangays = []; // Initialize as empty array
    public function render()
    {
        $cities = City::all();
        return view('livewire.admin.students-profile', compact('cities'))
        ->extends('layouts.dashboard.index')
        ->section('content');
    }

    public function updatedSelectedCity($cityId)
    {
        $this->municipalities = Municipal::where('city_id', $cityId)->get();
        $this->selectedMunicipality = null;
        $this->selectedBarangay = null;
        $this->barangays = [];
    }

    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangay = null;
    }
}
