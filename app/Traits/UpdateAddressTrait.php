<?php
namespace App\Traits;

use App\Models\Municipal;
use App\Models\Barangay;

trait UpdateAddressTrait
{
    public $selectedCity;
    public $selectedMunicipality;
    public $selectedBarangay;

    public function updatedSelectedCity($cityId)
    {
        $this->municipalities = Municipal::where('province_id', $cityId)->get();
    }
    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('municipal_id', $municipalityId)->get();
    }

}
