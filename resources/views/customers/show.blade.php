@php
    $title = 'Просмотр покупателя'
@endphp
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Информация о клиенте</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-12">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-lg-6">
                    <div class="card report-card">
                        <div class="card-header">
                            <div class="fs-5">
                                Общее
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">ФИО</label>
                                <input class="form-control" disabled
                                       value="{{$customer->last_name}} {{$customer->first_name}} {{$customer->middle_name ?? ''}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" disabled
                                       value="{{$customer->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Номер телефона</label>
                                <input class="form-control" disabled
                                       value="{{$customer->phone_number}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Дата регистрации</label>
                                <input class="form-control" disabled
                                       value="{{$customer->created_at->format('d.m.Y h:i')}}">
                            </div>
                            <div>
                                <label class="form-label">Дата изменения</label>
                                <input class="form-control" disabled
                                       value="{{$customer->updated_at->format('d.m.Y h:i')}}">
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
                <div class="col-lg-6">
                    <div class="card report-card">
                        <div class="card-header">
                            <div class="fs-5">
                                Отзывы
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="mb-3">
                                Всего оставлено отзывов: {{$customer->reviews()->count()}}
                            </div>
                            <table id="customer-reviews" class="table dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Товар</th>
                                    <th>Содержание</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->reviews as $review)
                                    <tr>
                                        <td>{{$review->id}}</td>
                                        <td>{{$review->product->specifications['name']}}</td>
                                        <td>{{$review->comment}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
                <div class="col-lg-12">
                    <div class="card report-card">
                        <div class="card-header">
                            <div class="fs-5">
                                Заказы
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="mb-3">
                                Всего заказов: {{$customer->orders()->count()}}
                            </div>
                            <table id="customer-orders" class="table dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Номер</th>
                                    <th>Время оформления</th>
                                    <th>Адрес</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->number}}</td>
                                        <td>{{$order->confirmed_at}}</td>
                                        <td>{{$order->address ?? '_'}}</td>
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div>

        </div><!--end col-->
    </div> <!-- end row -->
@endsection
