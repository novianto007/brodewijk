<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class FabricColor extends JsonResource
{
    private $resourceList = null;
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
            'code' => $this->code,
            'name' => $this->name,
            'image' => $this->image,
            'resources' => $this->getResource($this->fabric, $this->path),
        ];
    }

    private function getResource($fabric, $path){
        if (!$path) return [];
        
        if ($this->resourceList == null){
            $product = $fabric->fabricType->product;
            $this->resourceList = (unserialize($product->resources))?unserialize($product->resources):[];
        }
        $imageResources = [];
        foreach ($this->resourceList as $key => $val){
            $resource = [
                "position" => $key,
                "image" => url($path .'/'. $val)
            ];
            array_push($imageResources, $resource);
        }
        return $imageResources;
    }
}