<?php

namespace App\Http\Controllers;

use App\Libraries\Midtrans;
use App\Models\OrderPayment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
    public function notificationHandler(Request $request)
    {
        //
    }

    public function finish(Request $request)
    {
        $order_id = $request->query('order_id');
        $orderPayment = OrderPayment::where('order_id', $order_id);
        if (!$orderPayment) {
            try {
                $data = app(Midtrans::class)->getPaymentInfo();
                OrderPayment::savePaymentInfo($data);
            } catch (Exception $e) {
                //
            }
        }
        return $this->response(false, 'success', null);
    }
}
