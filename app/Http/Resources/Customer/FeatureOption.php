<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureOption extends JsonResource
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
            'image' => $this->image,
            'is_has_child' => $this->is_has_child,
            'description' => $this->description,
            'resources' => $this->getResource(),
            'code_name' => $this->code_name,
            'resource_depend' => $this->resource_depend,
            'prices' => FeaturePrice::collection($this->featurePrices),
            'childs' => $this->when($this->is_has_child, FeatureOptionChild::collection($this->featureOptionChildren)),
        ];
    }

    private function getResource(){     
        $resourceList = (unserialize($this->resources))?unserialize($this->resources):[];
        return $this->generateWithDepend($resourceList);
    }

    private function generateWithDepend($imageResources){
        if($this->resource_depend){
            $newResourceList = [];
            foreach($this->depend->featureOptions as $option){
                foreach($imageResources as $key => $val){
                    $imageResources[$key] = str_replace('{depend}', $option->code_name, $val);
                }
                $newResourceList[$option->code_name] = $imageResources;
            }
            return $newResourceList;
        }
        return $imageResources;
    }
}