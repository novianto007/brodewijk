<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    protected $extraField;

    public function addExtraField($field)
    {
        $this->extraField = $field;
        return $this;
    }
}
