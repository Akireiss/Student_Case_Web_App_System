<?php
namespace App\Traits;

trait SiblingsTrait
{
    public $siblings = [
        ['name' => '', 'age' => '', 'gradeSection' => ''],
    ];

    public function addSibling()
    {
        $this->siblings[] = ['name' => '', 'age' => '', 'gradeSection' => ''];
    }

    public function removeSibling($index)
    {
        unset($this->siblings[$index]);
        $this->siblings = array_values($this->siblings); // Re-index the array after removing a sibling
    }

}
