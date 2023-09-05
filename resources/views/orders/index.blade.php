@php
    $title = 'Заказы'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все заказы</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-12">
            <table id="datatable-buttons" class="table dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Номер</th>
                    <th>Статус</th>
                    <th>Время оформления</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->number}}</td>
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
                        <td>{{$order->confirmed_at->format('d.m.Y h:i')}}</td>
                        <td>
                            <div class="row">
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
                                <div class="col-auto">
                                    <a href="{{route('orders.show', $order)}}" class="text-primary"><i
                                            data-feather="eye"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
