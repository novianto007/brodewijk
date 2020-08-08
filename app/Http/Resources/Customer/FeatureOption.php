<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class FeatureOption extends BaseResource
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
            'selected' => $this->id == $this->extraField->option_value,
            'image' => $this->image,
            'is_has_child' => $this->is_has_child,
            'description' => $this->description,
            'description_ind' => $this->description_ind,
            'resources' => $this->getResource(),
            'code_name' => $this->code_name,
            'resource_depend' => $this->resource_depend,
            'prices' => FeaturePrice::collection($this->featurePrices),
            'childs' => $this->when($this->is_has_child, FeatureOptionChild::collection($this->featureOptionChildren)->addExtraField($this->extraField)),
        ];
    }

    public static function collection($resource)
    {
        return new FeatureOptionCollection($resource);
    }

    private function getResource()
    {
        $resourceList = (unserialize($this->resources)) ? unserialize($this->resources) : [];
        return $this->generateWithDepend($resourceList);
    }

    private function generateWithDepend($imageResources)
    {
        if ($this->resource_depend) {
            $newResourceList = [];
            foreach ($this->depend->featureOptions as $option) {
                foreach ($imageResources as $key => $val) {
                    $imageResources[$key] = str_replace('{depend}', $option->code_name, $val);
                }
                $newResourceList[$option->code_name] = $imageResources;
            }
            return $newResourceList;
        }
        return $imageResources;
    }
}
