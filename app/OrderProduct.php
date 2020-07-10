<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'product_price', 'is_customized', 'fabric_color_id', 'fabric_price', 'note'
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

    public function orderMeasurement()
    {
        return $this->hasOne(OrderMeasurement::class);
    }
}
