<?php
namespace App\Traits;

use App\Models\Award;

trait RewardSiblingTrait
{

    public $education = [];
    public $school_name = [];
    public $grade_section = [];
    public $school_year = [];
    public $rewards = [];
    public $siblings = [];
    public $inputs = [''];

    public function addSibling()
    {
        $this->siblings[] = [
            'name' => '',
            'age' => '',
            'gradeSection' => '',
        ];
    }


    public function removeSibling($index)
    {
        unset($this->siblings[$index]);
        $this->siblings = array_values($this->siblings);

    }



    public function addReward()
    {
        $this->rewards[] = [
            'name' => '',
            'year' => '',
        ];
    }

    public function saveAwards()
    {
        foreach ($this->rewards as $index => $reward) {
            $rewardModel = $this->profile->awards[$index] ?? new Award();

            $rewardModel->updateOrCreate(
                ['id' => $rewardModel->id],
                [
                    'profile_id' => $this->profileId,
                    'award_name' => $reward['name'],
                    'award_year' => $reward['year'],
                ]
            );
        }

    }

    public function removeAward($index)
    {
        if (isset($this->rewards[$index])) {
            $rewardModel = $this->profile->awards[$index] ?? null;

            if ($rewardModel) {
                $rewardModel->delete();
            }

            unset($this->rewards[$index]);
            $this->rewards = array_values($this->rewards);
        }
    }


}
