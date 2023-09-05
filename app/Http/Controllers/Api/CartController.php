<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if($order->customer->id != Auth::user()->getAuthIdentifier()){
            return response(['message' => 'Нет доступа к эти данным'], 403);
        }

        if(is_null($order))
        {
            return response(['message' => 'Корзина пустая']);
        }

        return new OrderResource($order);
    }

    private function decreaseProductsCount(Product $product){
        foreach ($product->inventories as $inventory){
            if($inventory->pivot->quantity > 0){
                $inventory->pivot->quantity--;
                $inventory->pivot->save();

                break;
            }
        }
    }

    public function addToCart(Request $request, int $productId)
    {
        $orderId = $request->orderId;

        $product = Product::find($productId);

        if($product == null)
        {
            return response(['message' => "Товар с id=$productId не найден"]);
        }

        if ($product->quantity == 0){
            return response(['message' => "Товар законичился"]);
        }

        if(is_null($orderId))
        {
            $order = Order::create([
                'number' => (string)rand(100000, 999999),
                'status' => Order::$ORDER_NOT_CONFIRMED,
                'customer_id' => Auth::user()->getAuthIdentifier()
            ]);

            $order->products()->attach($product, ['product_count' => 1]);

            $this->decreaseProductsCount($product);
            return new OrderResource(Order::find($order->id));
        }

        $order = Order::find($orderId);
        if(!$order){
            return ['message' => 'Заказ не найден'];
        }

        if ($order->status == Order::$ORDER_CONFIRMED){
            return ['message' => 'Заказ уже оформлен'];
        }

        if($order->products->contains($productId))
        {
            $rowPivot = $order->products()->where('product_id', $productId)->first()->pivot;
            $rowPivot->product_count++;
            $rowPivot->update();
        }
        else
        {
            $order->products()->attach($product, ['product_count' => 1]);
        }

        $this->decreaseProductsCount($product);

        return new OrderResource(Order::find($orderId));
    }
}
