<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class Product extends BaseResource
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
            'description' => $this->description,
            'category' => (new Category($this->category))->addExtraField($this->getResource()),
            'image' => $this->image,
            'slug' => $this->slug,
        ];
    }

    /**
     * @return Array
     */
    private function getResource()
    {
        $resources = [];
        $depends = [];
        foreach ($this->productFeatures as $row) {
            $featureOption = $row->optionValue;
            if ($featureOption->resources) {
                $res = $featureOption->resourceData;
                if ($featureOption->resource_depend) {
                    if (array_key_exists($featureOption->resource_depend, $depends)) {
                        foreach ($res as $key => $val) {
                            $res[$key] = str_replace('{depend}', $depends[$featureOption->resource_depend], $val);
                        }
                    } else {
                        $depends[$featureOption->feature_id] = $featureOption->code_name;
                        $res = [];
                    }
                }
                $resources = array_merge($resources, $res);
            }
            if ($featureOption->is_has_child) {
                $optionChild = $row->childValue;
                if ($optionChild && $optionChild->resources) {
                    $res = $optionChild->resourceData;
                    $resources = array_merge($resources, $res);
                }
            }
        }
        return $resources;
    }
}
