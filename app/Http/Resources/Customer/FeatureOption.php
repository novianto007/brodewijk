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
        return $this->generateWithDepend($this->resourceData);
    }

    private function generateWithDepend($imageResources)
    {
        if ($this->resource_depend) {
            $newResourceList = [];
            foreach ($this->depend->featureOptions as $option) {
                $newResource = [];
                foreach ($imageResources as $key => $val) {
                    $newResource[$key] = str_replace('{depend}', $option->code_name, $val);
                }
                $newResourceList[$option->code_name] = $newResource;
            }
            return $newResourceList;
        }
        return $imageResources;
    }
}
