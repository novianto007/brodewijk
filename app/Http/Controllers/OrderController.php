<?php

namespace App\Http\Controllers;

use App\Libraries\Midtrans;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function placeOrder(Request $request)
    {
        $order = $this->validateOrder($request);
        $address = $this->validateShipementAddress($request);
        if (!$cart = Cart::where('customer_id', Auth::user()->id)->first()) {
            return $this->response(true, 'cart is empty', null, 422);
        }
        $order->customer_id = Auth::user()->id;
        $order->total_price = $cart->total_price;
        $order->order_product_ids = $cart->order_product_ids;
        if ($promoCode = $request->promo_code) {
            if (!$promo = Promo::getByCode($promoCode)) {
                return $this->response(true, 'invalid promo code', null, 422);
            }

            if ($promo->promoRules->isNotEmpty()) {
                if (!$promo->validatePromoRules($cart)) {
                    return $this->response(true, 'can not use promo code', null, 422);
                }
            }
            $order->discount_price = $promo->getDiscountPrice($cart->total_price);
        }
        $order->shipment_address = $address->toAddressString();
        $order->shipment_note = $address->note;
        $order->save();
        $respData =  [
            "order_data" => $order,
            "payment_data" => app(Midtrans::class)->getToken($order)
        ];
        return $this->response(false, 'order successfully created', $respData);
    }

    private function validateOrder(Request $request)
    {
        $this->customValidate($request, $request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/(08)[0-9]{8,13}/',
            'promo_code' => 'string',
            'shipment_address' => 'required|array',
        ]);
        return new Order($request->all());
    }

    private function validateShipementAddress(Request $request)
    {
        $this->customValidate($request, $request->only('shipment_address'), [
            'shipment_address.address' => 'required|string',
            'shipment_address.province_id' => 'required|integer|exists:provinces,id',
            'shipment_address.city_id' => 'required|integer|exists:cities,id',
            'shipment_address.district_id' => 'required|integer|exists:districts,id',
            'shipment_address.postcode' => 'required|string',
            'shipment_address.note' => 'string',
        ]);
        return new Address($request->shipment_address);
    }
}
