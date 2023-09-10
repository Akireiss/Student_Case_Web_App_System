<?php
namespace App\Traits;

trait AddSiblingRewardTrait
{
    public $awards = [
        ['award_name' => '', '' => ''],
    ];


    public function addAward()
    {
        $this->awards[] = ['award_name' => '', 'award_year' => ''];
    }

    public function removeAward($index)
    {
        unset($this->awards[$index]);
        $this->awards = array_values($this->awards);
    }

    public $siblings= [
        ['name' => '', 'age' => '', 'grade_section' => ''],
    ];

    public function addSibling()
    {
        $this->siblings[] = ['name' => '', 'age' => '', 'grade_section' => ''];
    }

    public function removeInput($index)
    {
        unset($this->siblings[$index]);
        $this->siblings= array_values($this->siblings);
    }

}
