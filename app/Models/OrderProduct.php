<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'product_price', 'extra_price', 'is_customized', 'fabric_id', 'fabric_color_id', 'fabric_price', 'note', 'description', 'image'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function updateExtraPrice($extraPrice)
    {
        if ($extraPrice > 0) {
            if ($this->extra_price > 0) {
                $extraPrice -= $this->extra_price;
            }
            $this->product_price += $extraPrice;
            $this->save();
            $order = $this->order;
            $order->total_price += $extraPrice;
            $order->save();
        } elseif ($this->extra_price > 0) {
            $this->product_price -= $this->extra_price;
            $order = $this->order;
            $order->total_price -= $this->extra_price;
            $order->save();
            $this->extra_price = 0;
            $this->save();
        }
    }

    public function orderFeatures()
    {
        return $this->hasMany(OrderFeature::class);
    }

    public function orderMeasurement()
    {
        return $this->hasOne(OrderMeasurement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
