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
            'childs' => $this->when($this->is_has_child, FeatureOptionChild::collection($this->featureOptionChilds)),
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
        return $this->generateWithDepend($imageResources);
    }

    private function generateWithDepend($imageResources){
        if($this->resource_depend){
            $newResourceList = [];
            foreach($this->depend->featureOptions as $option){
                $oldResources = $imageResources;
                foreach($oldResources as $row){
                    $row["image"] = str_replace('{depend}', $option->code_name, $row["image"]);
                }
                $newResourceList[$option->code_name] = $oldResources;
            }
            return $newResourceList;
        }
        return $imageResources;
    }
}