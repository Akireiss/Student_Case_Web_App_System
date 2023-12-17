<?php
namespace App\Traits;

trait StudentTrait
{
    public $status;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $lrn;
    public $classroom_id;
    public $gender;


    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'lrn' => 'nullable|numeric|unique:students,lrn',
        'classroom_id' => 'required',
        'status' => 'required',
    ];
}
