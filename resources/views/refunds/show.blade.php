@php
    $title = 'Отмененный заказ'
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
                                <div class="col-auto"><a href="{{route('refunds.index')}}" class="link-primary">Все
                                        возвраты</a></div>
                            </div>
                        </div>
                        <div class="card-body ps-2 pe-2 col-auto">
                            <table class="table table-responsive">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Номер заказа</th>
                                    <th>Дата оформления</th>
                                    <th>Сумма возврата</th>
                                    <th>ФИО покупателя</th>
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
                                        <div class="row float-right">
                                            <div class="col-auto">
                                                <form method="POST" action="{{route('refunds.destroy', $order)}}">
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
                </div>
            </div>
        </div>
    </section>
@endsection
