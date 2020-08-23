<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static $STATUS_CREATED = 0;
    public static $STATUS_WAITING_PAYMENT = 1;
    public static $STATUS_PAYMENT_SUCCESS = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'phone_number', 'promo_code'
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

    public function updateStatus($status)
    {
        switch ($status) {
            case 'pending':
                $this->status = static::$STATUS_WAITING_PAYMENT;
                break;
            case 'settlement':
                $this->status = static::$STATUS_PAYMENT_SUCCESS;
                break;
        }
        $this->save();
    }
}
