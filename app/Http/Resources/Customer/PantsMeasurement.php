<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class PantsMeasurement extends BaseResource
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
            'pants_length' => $this->pants_length,
            'trouser_waist' => $this->trouser_waist,
            'crotch' => $this->crotch,
            'thigh' => $this->thigh,
            'knee' => $this->knee,
            'ankle' => $this->ankle,
            'pants_hips' => $this->pants_hips
        ];
    }
}
