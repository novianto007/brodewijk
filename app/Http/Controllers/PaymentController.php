<?php

namespace App\Http\Controllers;

use App\Libraries\Midtrans;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderPayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function notification(Request $request)
    {
        $data = $request->all();
        if(!app(Midtrans::class)->verifySignatureKey($data)){
            return $this->response(true, 'error', null, 422);    
        }
        $orderPayment = OrderPayment::where('order_id', $data['order_id'])->first();
        if ($orderPayment) {
            $orderPayment->updatePaymentInfo($data);
        } elseif ($order = Order::find($data['order_id'])) {
            OrderPayment::savePaymentInfo($data);
            Cart::where('customer_id', $order->customer_id)->delete();
        }
        return $this->response(false, 'success', null);
    }

    public function finish(Request $request)
    {
        $orderId = $request->query('order_id');
        $orderPayment = OrderPayment::where('order_id', $orderId)->first();
        if (!$orderPayment) {
            DB::beginTransaction();
            try {
                $data = app(Midtrans::class)->getPaymentInfo($orderId);
                OrderPayment::savePaymentInfo($data);
                $order = Order::find($orderId);
                $order->updateStatus($data['transaction_status']);
                Cart::where('customer_id', $order->customer_id)->delete();
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
        return $this->response(false, 'success', null);
    }
}
