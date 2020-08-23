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
                $vaNumbers = isset($paymentInfo['va_numbers']) ? $paymentInfo['va_numbers'][0] : [];
                $data = self::getMetaFieldValue([], $vaNumbers, 'bank');
                return self::getMetaFieldValue($data, $vaNumbers, 'va_number');
            case 'echannel':
                $data = self::getMetaFieldValue([], $paymentInfo, 'bill_key');
                return self::getMetaFieldValue($data, $paymentInfo, 'biller_code');
            case 'cstore':
                $data = self::getMetaFieldValue([], $paymentInfo, 'approval_code');
                $data = self::getMetaFieldValue($data, $paymentInfo, 'payment_code');
                return self::getMetaFieldValue($data, $paymentInfo, 'store');
            default:
                return self::getMetaFieldValue([], $paymentInfo, 'approval_code');
        }
    }

    private static function getMetaFieldValue($field, $data, $key)
    {
        if (isset($data[$key])) {
            return array_merge($field, [$key => $data[$key]]);
        }
        return $field;
    }

    public static function saveMeta($orderPaymentId, $data)
    {
        $metaField = self::getMetaField($data);
        $metaData = self::transformField($orderPaymentId, $metaField);
        self::where('order_payment_id', $orderPaymentId)->delete();
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
