<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFabric extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'fabric_id', 'fabric_color_id', 'price'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function orderFeatures()
    {
        return $this->hasMany(OrderFeature::class);
    }
}
