<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function orderProduct()
    {
        return $this->hasOne(OrderProduct::class);
    }

    public static function getCartData($customerId)
    {
        $order = self::where('customer_id', $customerId)->where('status', self::$STATUS_CART)->first();
        if (!$order) {
            $order = self::create(['customer_id' => $customerId, 'total_price' => 0, 'status' => self::$STATUS_CART]);
        }
        return $order;
    }

    public static function saveCart($product, $measurement, $features, $cloth, $pants)
    {
        return DB::transaction(function () use ($product, $measurement, $features, $cloth, $pants) {
            $order = self::getCartData(Auth::user()->id);
            $orderProduct = $order->orderProduct()->create($product);
            $orderProduct->orderFeatures()->createMany($features);
            $measurement = $orderProduct->orderMeasurement()->create($measurement);
            if ($cloth) {
                $cloth = ClothMeasurement::create($cloth);
                $measurement->clothMeasurement()->associate($cloth);
            }
            if ($pants) {
                $pants = PantsMeasurement::create($pants);
                $measurement->pantsMeasurement()->associate($pants);
            }
            $measurement->save();
            $order->total_price += $orderProduct->product_price;
            $order->save();
            return $order;
        });
    }
}
