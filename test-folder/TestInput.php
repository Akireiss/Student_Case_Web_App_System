<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestInput extends Component
{
    public $awards = [
        ['award_name' => 'Best Student', 'award_year' => '2023'],
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

    public $inputs = [
        ['name' => 'John Doe', 'age' => '30', 'grade_section' => 'A'],
    ];

    public function addSibling()
    {
        $this->inputs[] = ['name' => '', 'age' => '', 'grade_section' => ''];
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs);
    }
    public function render()
    {
        return view('livewire.test-input')->extends('layouts.app')->section('content');
    }
}
