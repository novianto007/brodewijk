<?php

namespace App\Libraries;

use Exception;
use Midtrans\ApiRequestor;

class Midtrans
{
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function getToken($order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->full_name,
                'email' => $order->email,
                'phone' => $order->phone_number,
            ],
        ];

        return \Midtrans\Snap::createTransaction($params);
    }

    public function getPaymentInfo($id)
    {
        $resp = (array) ApiRequestor::remoteCall("https://api.sandbox.midtrans.com/v2/$id/status", \Midtrans\Config::$serverKey, null, false);
        if (!$this->verifySignatureKey($resp)) {
            throw new Exception('invalid signature');
        }
        return $resp;
    }

    public function verifySignatureKey($data)
    {
        $key = $data['order_id'] . $data['status_code'] . $data['gross_amount'] . \Midtrans\Config::$serverKey;
        $signature = hash('sha512', $key, false);
        return $signature == $data['signature_key'];
    }
}
