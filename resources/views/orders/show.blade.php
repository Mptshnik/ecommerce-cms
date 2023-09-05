@php
    $title = 'Заказы'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="h3 col-auto">Заказ №{{$order->number}}</div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto"><a href="{{route('orders.index')}}" class="link-primary">Все
                                        заказы</a></div>
                            </div>
                        </div>
                        <div class="card-body ps-2 pe-2 col-auto">
                            <table class="table table-responsive">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Номер заказа</th>
                                    <th>Дата оформления</th>
                                    <th>Сумма заказа</th>
                                    <th>ФИО покупателя</th>
                                    <th>Статус заказа</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->number}}</td>
                                    <td>{{$order->confirmed_at->format('d.m.Y H:i')}}</td>
                                    <td>{{$order->total_sum}} ₽</td>
                                    <td>
                                        @php
                                            $last_name = $order->customer->last_name;
                                            $first_name = $order->customer->first_name;
                                            $middle_name = $order->customer->middle_name;
                                        @endphp
                                        {{$last_name}} {{$first_name}} @if($middle_name)
                                            {{$middle_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == \App\Models\Order::$ORDER_CONFIRMED)
                                            <span class="badge rounded-pill bg-primary">Оформлен</span>
                                        @elseif($order->status == \App\Models\Order::$ORDER_READY)
                                            <span class="badge rounded-pill bg-secondary">Готов к выдаче</span>
                                        @elseif($order->status == \App\Models\Order::$ORDER_CANCELLED)
                                            <span class="badge rounded-pill bg-danger">Отменен</span>
                                        @elseif($order->status == \App\Models\Order::$ORDER_SHIPPED)
                                            <span class="badge rounded-pill bg-success">Доставлен</span>
                                        @elseif($order->status == \App\Models\Order::$ORDER_TAKEN)
                                            <span class="badge rounded-pill bg-success">Выдан</span>
                                        @elseif($order->status == \App\Models\Order::$ORDER_IS_SHIPPING)
                                            <span class="badge rounded-pill bg-secondary">В доставке</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row float-right">
                                            <div class="col-auto">
                                                <form method="POST" action="{{route('orders.destroy', $order)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-danger trash"
                                                            onclick="return confirm('Удалить запись?')">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Товары</h4>
                        </div>
                        <div class="card-body">
                            @if($order->products->count() > 0)
                                <div class="row row-cols-1 row-cols-md-5 g-4">
                                    @foreach($order->products as $product)
                                        <div class="col mt-4">
                                            <div class="card h-100">
                                                <img class="card-img-top" alt="not found image"
                                                     src="{{\Illuminate\Support\Facades\Storage::url($product->images()->first()->url) ?? ''}}">
                                                <div class="card-body">
                                                    {{$product->specifications['name']}}
                                                </div>
                                                <div class="card-footer">
                                                    {{$product->items_count}} шт.
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h4>
                                    Товаров пока нет.
                                </h4>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="fs-5">Информация о клиенте</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">ФИО: {{$last_name}} {{$first_name}} @if($middle_name)
                                        {{$middle_name}}
                                    @endif</li>
                                <li class="list-group-item">Email: {{$order->customer->email}}</li>
                                <li class="list-group-item">Номер телефона: {{$order->customer->phone_number}}</li>
                                @if($order->shipping)
                                    <li class="list-group-item">Адрес доставки: {{$order->address}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @if($order->status != \App\Models\Order::$ORDER_CANCELLED)
                        @if($order->shipping && $order->status != \App\Models\Order::$ORDER_IS_SHIPPING
                            && $order->status != \App\Models\Order::$ORDER_SHIPPED)
                            <form method="post" action="{{route('orders.shipping', $order)}}">
                                @csrf
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success">Передать заказ в доставку
                                    </button>
                                </div>
                            </form>
                        @elseif($order->status != \App\Models\Order::$ORDER_READY
                                && $order->status != \App\Models\Order::$ORDER_IS_SHIPPING
                                && $order->status != \App\Models\Order::$ORDER_SHIPPED
                                && $order->status != \App\Models\Order::$ORDER_TAKEN)
                            <form method="post" action="{{route('orders.ready', $order)}}">
                                @csrf
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success">Заказ готов к выдаче
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if($order->status == \App\Models\Order::$ORDER_READY)
                            <form method="post" action="{{route('orders.taken', $order)}}">
                                @csrf
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success">Выдать заказ
                                    </button>
                                </div>
                            </form>
                        @elseif($order->status == \App\Models\Order::$ORDER_IS_SHIPPING)
                            <form method="post" action="{{route('orders.shipped', $order)}}">
                                @csrf
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success">Заказ доставлен
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endif


                    @if($order->status != \App\Models\Order::$ORDER_CANCELLED &&
                        $order->status != \App\Models\Order::$ORDER_SHIPPED &&
                        $order->status != \App\Models\Order::$ORDER_TAKEN)
                        <form method="post" action="{{route('orders.cancel', $order)}}">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-danger">Отменить заказ
                                </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
