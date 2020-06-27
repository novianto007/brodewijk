<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class FabricColor extends BaseResource
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
            'selected' => $this->id == $this->extraField->fabric_color_id,
            'code' => $this->code,
            'name' => $this->name,
            'image' => $this->image,
            'path' => url($this->path),
        ];
    }

    public static function collection($resource)
    {
        return new FabricColorCollection($resource);
    }
}
