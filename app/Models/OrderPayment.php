<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Midtrans\Transaction;

class OrderPayment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'transaction_id', 'payment_type', 'transaction_time', 'transaction_status', 'fraud_status', 'status_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function updatePaymentInfo($data)
    {
        DB::transaction(function () use ($data) {
            $this->update($data);
            PaymentMeta::saveMeta($this->id, $data);
        });
    }

    public static function savePaymentInfo($data)
    {
        $orderPayment = OrderPayment::create($data);
        PaymentMeta::saveMeta($orderPayment->id, $data);
    }
}
