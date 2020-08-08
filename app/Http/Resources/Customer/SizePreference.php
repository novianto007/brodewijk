<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class SizePreference extends BaseResource
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
            'fit_option' => [
                'id' => $this->fitOption->id,
                'name' => $this->fitOption->name
            ],
            'height' => $this->height,
            'weight' => $this->weight,
            'cloth_measurement' => new ClothMeasurement($this->clothMeasurement),
            'pants_measurement' => new PantsMeasurement($this->pantsMeasurement)
        ];
    }
}
