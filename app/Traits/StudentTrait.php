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

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'lrn' => 'required|numeric',
        'classroom_id' => 'required',
        'status' => 'required|in:0,1',
    ];
}
