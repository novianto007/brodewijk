<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoRule extends Model
{
    public static $TYPE_MIN = "min";
    public static $TYPE_START_DATE = "start_at";
    public static $TYPE_END_DATE = "end_at";
    public static $TYPE_FABRIC = "fabric";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promo_id', 'type', 'value'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function validatePromo($cart)
    {
        switch ($this->type) {
            case self::$TYPE_MIN:
                return $this->validateMinPurchase($cart->total_price);
            case self::$TYPE_START_DATE:
                return $this->validateDateAfter(new \DateTime());
            case self::$TYPE_END_DATE:
                return $this->validateDateBefore(new \DateTime());
            case self::$TYPE_FABRIC:
                return $this->validateFabric($cart);
        }
        return false;
    }

    private function validateMinPurchase($totalPrice)
    {
        return $totalPrice > $this->value;
    }

    private function validateDateAfter($date)
    {
        return $date >= (new \DateTime($this->value));
    }

    private function validateDateBefore($date)
    {
        return $date <= (new \DateTime($this->value));
    }

    private function validateFabric($cart)
    {
        $fabrics = array_map(function ($data) {
            return $data['fabric_id'];
        }, $cart->orderProducts()->toArray());

        $valFabrics = unserialize($this->value);
        $results = array_intersect($fabrics, $valFabrics);
        return sizeof($results) > 0;
    }
}
