<?php

namespace App\Http\Livewire\Adviser;

use Livewire\Component;


class Report extends Component
{
public function render() {
    return view('livewire.adviser.report')
    ->extends('layouts.dashboard.index')
        ->section('content');
}
}
