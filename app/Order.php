<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'product_id', 'customer_id', 'is_customized', 'note', 'price', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function orderFabric()
    {
        return $this->hasOne(OrderFabric::class);
    }

    public function orderMeasurement()
    {
        return $this->hasOne(OrderMeasurement::class);
    }
}
