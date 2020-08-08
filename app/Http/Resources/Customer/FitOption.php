<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class FitOption extends BaseResource
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
            'name' => $this->name,
            'description' => $this->description,
            'sizes' => DefaultMeasurement::collection($this->orderedDefaultMeasurement())
        ];
    }
}
