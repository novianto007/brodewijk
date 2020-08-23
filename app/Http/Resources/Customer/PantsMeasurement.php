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
            'waist' => $this->waist,
            'seat' => $this->seat,
            'crotch' => $this->crotch,
            'thigh' => $this->thigh,
            'knee' => $this->knee,
            'leg_length' => $this->leg_length
        ];
    }
}
