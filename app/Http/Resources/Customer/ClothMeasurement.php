<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class ClothMeasurement extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'neck' => $this->neck,
            'shoulder' => $this->shoulder,
            'bicep' => $this->bicep,
            'chest' => $this->chest,
            'waist' => $this->waist,
            'arm_length' => $this->arm_length,
            'torso_length' => $this->torso_length,
            'stomach' => $this->stomach,
            'wrist' => $this->wrist
        ];
    }
}
