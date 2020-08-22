<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMeta extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_payment_id', 'meta_key', 'meta_value'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function getMetaField($paymentInfo)
    {
        switch ($paymentInfo['payment_type']) {
            case 'bank_transfer':
                if (isset($paymentInfo['permata_va_number'])) {
                    return [
                        'bank' => 'permata',
                        'va_number' => $paymentInfo['permata_va_number']
                    ];
                }
                return [
                    'bank' => $paymentInfo['va_numbers'][0]['bank'],
                    'va_number' => $paymentInfo['va_numbers'][0]['va_number'],
                ];
            case 'echannel':
                return [
                    'bill_key' => $paymentInfo['bill_key'],
                    'biller_code' => $paymentInfo['biller_code']
                ];
            case 'cstore':
                return [
                    'approval_code' => $paymentInfo['approval_code'],
                    'payment_code' => $paymentInfo['payment_code'],
                    'store' => $paymentInfo['store'],
                ];
            default:
                return [
                    'approval_code' => $paymentInfo['approval_code']
                ];
        }
    }

    public static function saveMeta($orderPaymentId, $data)
    {
        $metaField = self::getMetaField($data);
        $metaData = self::transformField($orderPaymentId, $metaField);
        self::insert($metaData);
    }

    private static function transformField($orderPaymentId, $data)
    {
        $newData = [];
        foreach ($data as $key => $val) {
            $meta = [
                'order_payment_id' => $orderPaymentId,
                'meta_key' => $key,
                'meta_value' => $val
            ];
            array_push($newData, $meta);
        }
        return $newData;
    }
}
