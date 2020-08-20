<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
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
    public function verifyCode($promoCode)
    {
        if (!$promo = Promo::getByCode($promoCode)) {
            return $this->response(true, 'invalid promo code', null, 400);
        }

        if (!$cart = Cart::where('customer_id', Auth::user()->id)->first()) {
            return $this->response(true, 'You do not have cart', null, 404);
        }

        if ($promo->promoRules->isNotEmpty()) {
            if (!$promo->validatePromoRules($cart)) {
                return $this->response(true, 'can not use promo code', null, 400);
            }
        }

        $discount = $promo->getDiscountPrice($cart->total_price);
        return $this->response(false, "Promo code is verified", [
            'discount_price' => $discount,
            'final_price' => $cart->total_price - $discount
        ]);
    }
}
