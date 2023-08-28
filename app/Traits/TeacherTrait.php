<?php
namespace App\Traits;

trait TeacherTrait
{
    public $employees;
    public $refference_number;
    public $status;

    protected $rules = [
        'employees' => 'required|string|max:255',
        'refference_number' => 'required',
        'status' => 'required|in:0,1',
    ];
}
