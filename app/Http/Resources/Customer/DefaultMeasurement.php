<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class DefaultMeasurement extends BaseResource
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
            'name' => $this->standardMeasurement->name,
            'height' => $this->height,
            'weight' => $this->weight,
            'cloth_measurement' => new ClothMeasurement($this->clothMeasurement),
            'pants_measurement' => new PantsMeasurement($this->pantsMeasurement),
        ];
    }
}
