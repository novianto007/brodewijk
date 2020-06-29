<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResource;

class ProductFeature extends BaseResource
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
            'id' => $this->feature->id,
            'name' => $this->feature->name,
            'type' => $this->feature->type,
            'description' => $this->feature->description,
            'options' => FeatureOption::collection($this->feature->featureOptions),
        ];
    }
}
