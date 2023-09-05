<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderConfirmationRequest;
use App\Http\Resources\OrderResource;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm(OrderConfirmationRequest $request, Order $order)
    {

        if($order->status == Order::$ORDER_NOT_CONFIRMED){
            $order['payment'] = $request->payment;
            $order['shipping'] = $request->shipping;
            $order['address'] = $request->address;
            $order['details'] = $request->details;
            $order['payed'] = $request->payed;
            $order['status'] = Order::$ORDER_CONFIRMED;
            $order['confirmed_at'] = Carbon::now()->toDateTimeString();;

            $order->save();

            Invoice::create([
                'number' => rand(100000, 999999),
                'order_id' => $order->id
            ]);

            return response([
                'order' => new OrderResource($order),
                'message' => 'Заказ оформлен'
            ]);
        }
        return ['message' => 'Заказ уже оформлен'];

    }
}
