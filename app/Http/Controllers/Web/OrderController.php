<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\OrderCompleted;
use App\Mail\OrderMail;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод всех заказов
     */
    public function index()
    {
        $orders = Order::where('status', '!=', Order::$ORDER_NOT_CONFIRMED)->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод одного заказа
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция возвращает редирект на страницу вывода заказа
     */
    public function cancel(Order $order)
    {
        $email = $order->customer->email;

        $data = [
            "subject" => "Заказ в интернет-магазине",
            "body" => "Добрый день! Ваш заказ №{$order->number} был отменен"
        ];

        $order->update(['status' => Order::$ORDER_CANCELLED]);

        if (!$order->payed){
            $order->invoice->delete();
        }

        foreach ($order->products as $product){
            $defaultInventory = $product->inventories()->first();

            $defaultInventory->pivot->quantity+=$product->items_count;
            $defaultInventory->pivot->save();
        }

        try {

            Mail::to($email)->send(new OrderMail($data));
            return redirect()->route('orders.show', $order)
                ->with('success', "Уведомление успешно отправлено на почту $email");
        } catch (Exception $e) {
            return redirect()->route('orders.show', $order)->with('fail', "Не удалось отправить уведомление");
        }
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция отвечает за смену статуса заказа
     * Функция возвращает редирект на страницу вывода заказа
     */
    public function orderReady(Order $order)
    {
        $email = $order->customer->email;

        $data = [
            "subject" => "Заказ в интернет-магазине",
            "body" => "Добрый день! Ваш заказ №{$order->number} готов к выдаче"
        ];

        try {
            $order->update(['status' => Order::$ORDER_READY]);

            Mail::to($email)->send(new OrderMail($data));
            return redirect()->route('orders.show', $order)
                ->with('success', "Уведомление успешно отправлено на почту $email");
        } catch (Exception $e) {
            return redirect()->route('orders.show', $order)->with('fail', "Не удалось отправить уведомление");
        }
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция отвечает за смену статуса заказа
     * Функция возвращает редирект на страницу вывода заказа
     */
    public function orderShipping(Order $order)
    {
        $email = $order->customer->email;

        $data = [
            "subject" => "Заказ в интернет-магазине",
            "body" => "Добрый день! Ваш заказ №{$order->number} передан в доставку"
        ];

        try {
            $order->update(['status' => Order::$ORDER_IS_SHIPPING]);

            Mail::to($email)->send(new OrderMail($data));
            return redirect()->route('orders.show', $order)
                ->with('success', "Уведомление успешно отправлено на почту $email");
        } catch (Exception $e) {
            return redirect()->route('orders.show', $order)->with('fail', "Не удалось отправить уведомление");
        }
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция отвечает за смену статуса заказа
     * Функция возвращает редирект на страницу вывода заказа
     */
    public function orderTaken(Order $order)
    {
        $order->update(['status' => Order::$ORDER_TAKEN]);

        return redirect()->route('orders.show', $order)
            ->with('success', "Статус заказ изменен");
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция отвечает за смену статуса заказа
     * Функция возвращает редирект на страницу вывода заказа
     */
    public function orderShipped(Order $order)
    {
        $order->update(['status' => Order::$ORDER_SHIPPED]);

        return redirect()->route('orders.show', $order)
            ->with('success', "Статус заказ изменен");
    }


    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * Функция принимает заказ
     * Функция отвечает удаление заказа
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index', $order)
            ->with('success', "Запись успешно удалена");
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * Вывод отмененных заказов
     */
    public function cancelledOrders(){
        $orders = Order::where('status',  Order::$ORDER_CANCELLED)->get();

        return view('refunds.index', compact('orders'));
    }
}
