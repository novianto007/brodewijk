<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public static $TYPE_DISCOUNT = 'discount';
    public static $TYPE_CUTOFF = 'cutoff';
    public static $ACTIVE = 1;
    public static $NONACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'code', 'type', 'amount', 'is_active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function getByCode($promoCode)
    {
        return Promo::where(['code' => $promoCode, 'is_active' => self::$ACTIVE])->first();
    }

    public function getDiscountPrice($totalPrice)
    {
        if ($this->type === self::$TYPE_CUTOFF) {
            return $this->amount;
        }
        return $this->amount * $totalPrice / 100;
    }

    public function promoRules()
    {
        return $this->hasMany(PromoRule::class);
    }

    public function validatePromoRules($cart)
    {
        $valid = true;
        foreach ($this->promoRules as $rule) {
            $valid = $rule->validatePromo($cart);
            if (!$valid) {
                return $valid;
            }
        }
        return $valid;
    }
}
