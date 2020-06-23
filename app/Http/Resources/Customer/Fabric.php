<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class Fabric extends JsonResource
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
            'type' => new FabricType($this->fabricType),
            'base_price' => $this->fabricType->base_price,
            'brand' => $this->brand,
            'grade' => $this->grade,
            'description' => $this->description,
            'color' => FabricColor::collection($this->fabricColors),
        ];
    }
}