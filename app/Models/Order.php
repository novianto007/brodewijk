<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

    public static $STATUS_CART = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'total_price', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public static function getCartData($customerId)
    {
        $order = self::where('customer_id', $customerId)->where('status', self::$STATUS_CART)->first();
        if (!$order) {
            $order = self::create(['customer_id' => $customerId, 'total_price' => 0, 'status' => self::$STATUS_CART]);
        }
        return $order;
    }

    public static function saveCart($product, $features, $customerId)
    {
        return DB::transaction(function () use ($product, $features, $customerId) {
            $order = self::getCartData($customerId);
            $orderProduct = $order->orderProducts()->create($product);
            $orderProduct->orderFeatures()->createMany($features);
            $order->total_price += $orderProduct->product_price;
            $order->save();
            return $order;
        });
    }
}
