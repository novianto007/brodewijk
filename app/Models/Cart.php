<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    public $productIds = array();

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'total_price'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $attributes = [
        'order_product_ids' => ''
    ];

    protected static function booted()
    {
        static::retrieved(function ($model) {
            if ($model->order_product_ids) {
                $model->productIds = unserialize($model->order_product_ids);
            }
            return true;
        });

        static::creating(function ($model) {
            if (sizeof($model->productIds) > 0) {
                $model->order_product_ids = serialize($model->productIds);
            }
            return true;
        });

        static::updating(function ($model) {
            $model->order_product_ids = serialize($model->productIds);
            return true;
        });
    }

    public function orderProducts()
    {
        return OrderProduct::whereIn('id', $this->productIds)->get();
    }

    public static function getOrCreate($customerId)
    {
        $cart = self::where('customer_id', $customerId)->first();
        if (!$cart) {
            $cart = self::create(['customer_id' => $customerId, 'total_price' => 0]);
        }
        return $cart;
    }

    public static function saveCart($product, $features, $customerId)
    {
        return DB::transaction(function () use ($product, $features, $customerId) {
            $cart = self::getOrCreate($customerId);
            $orderProduct = OrderProduct::create($product);
            $orderProduct->orderFeatures()->createMany($features);
            array_push($cart->productIds, $orderProduct->id);
            $cart->total_price += $orderProduct->product_price;
            $cart->save();
            return $cart;
        });
    }
}
