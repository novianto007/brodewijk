<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class FeatureOptionChild extends BaseResource
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
            'selected' => $this->id == $this->extraField->child_value,
            'name' => $this->name,
            'image' => $this->image,
            'resources' => $this->resourceData,
        ];
    }

    public static function collection($resource)
    {
        return new FeatureOptionChildCollection($resource);
    }
}
