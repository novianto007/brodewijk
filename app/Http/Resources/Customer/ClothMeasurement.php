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
            'front_length' => $this->front_length,
            'shoulder_width' => $this->shoulder_width,
            'sleeve_length' => $this->sleeve_length,
            'chest' => $this->chest,
            'waist' => $this->waist,
            'hips' => $this->hips,
            'armpits' => $this->armpits,
            'biceps' => $this->biceps,
            'wrist' => $this->wrist,
            'front_chest' => $this->front_chest,
            'back_chest' => $this->back_chest
        ];
    }
}
