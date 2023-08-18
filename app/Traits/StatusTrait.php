<?php
namespace App\Traits;

trait StatusTrait
{
    public function getStatusTextAttribute()
    {
        $statusCodes = [
            0 => 'Active',
            1 => 'Inactive',
        ];

        return $statusCodes[$this->attributes['status']] ?? '';
    }

}
