<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class Category extends BaseResource
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
            'type' => $this->type,
            'name' => $this->name,
            'resources' => $this->getResource(),
            'slug' => $this->slug,
        ];
    }

    private function getResource()
    {
        $resourceList = (unserialize($this->resources)) ? unserialize($this->resources) : [];
        return is_array($this->extraField) ? array_merge($resourceList, $this->extraField) : $resourceList;
    }
}
