<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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

    private function getResource(){     
        $resourceList = (unserialize($this->resources))?unserialize($this->resources):[];
        $imageResources = [];
        foreach ($resourceList as $key => $val){
            $resource = [
                "position" => $key,
                "image" => $val
            ];
            array_push($imageResources, $resource);
        }
        return $imageResources;
    }
}