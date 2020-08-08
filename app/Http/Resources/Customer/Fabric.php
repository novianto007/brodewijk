<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class Fabric extends BaseResource
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
            'selected' => $this->id == $this->extraField->fabric_id,
            'name' => $this->name,
            'type' => new FabricType($this->fabricType),
            'brand' => $this->brand,
            'grade' => $this->grade,
            'description' => $this->description,
            'description_ind' => $this->description_ind,
            'colors' => FabricColor::collection($this->fabricColors)->addExtraField($this->extraField),
        ];
    }

    public static function collection($resource)
    {
        return new FabricCollection($resource);
    }
}
