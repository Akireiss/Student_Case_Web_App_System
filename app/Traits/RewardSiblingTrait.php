<?php
namespace App\Traits;

use App\Models\Award;
use App\Models\Sibling;

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

        foreach ($this->siblings as $index => $sibling) {
            $siblingModel = $this->profile->siblings[$index] ?? new Sibling();

            $siblingModel->updateOrCreate(
                ['id' => $siblingModel->id],
                [
                    'profile_id' => $this->profileId,
                    'sibling_name' => $sibling['name'],
                    'sibling_age' => $sibling['age'],
                    'sibling_grade_section' => $sibling['gradeSection'],
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


    public function removeSiblings($index)
    {
        if (isset($this->siblings[$index])) {
            $siblingModel = $this->profile->siblings[$index] ?? null;

            if ($siblingModel) {
                $siblingModel->delete();
            }

            unset($this->siblings[$index]);
            $this->siblings = array_values($this->siblings);
        }
    }



}
