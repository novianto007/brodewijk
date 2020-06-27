<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    protected $extraField;

    public function addExtraField($field)
    {
        $this->extraField = $field;
        return $this;
    }

    public function toArray($request)
    {
        return $this->collection->map(function ($resource) use ($request) {
            return $resource->addExtraField($this->extraField)->toArray($request);
        })->all();
    }
}
