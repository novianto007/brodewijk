<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'province' => $this->province->name,
            'city' => $this->city->name,
            'district' => $this->district->name,
            'postcode' => $this->postcode,
            'note' => $this->note
        ];
    }
}
