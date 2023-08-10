<?php
namespace App\Traits;

use App\Models\Municipal;
use App\Models\Barangay;


trait SelectAddressTrait
{
    public $selectedCity;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = []; // Initialize as empty array
    public $barangays = [];

    public function updatedSelectedCity($cityId)
    {
        $this->municipalities = Municipal::where('province_id', $cityId)->get();
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
