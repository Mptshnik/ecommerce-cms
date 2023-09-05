@php
 $title = 'Просмотр счета';
@endphp
@extends('layouts.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="h3 col-auto">Счет №{{$invoice->number}}</div>
                    <a href="{{route('invoices.index')}}" class="link-blue">Все счета</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="">
                                        <h6 class="mb-0"><b>Время формирования счета :</b> {{$invoice->created_at->format('d.m.y h:i')}}</h6>
                                        <h6><b>ID заказа :</b> {{$invoice->order->id}}</h6>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-3">
                                    <div class="float-left">
                                        <address class="font-13">
                                            <strong class="font-14">Клиент :</strong><br>
                                            {{$invoice->order->customer->last_name}} {{$invoice->order->customer->first_name}} {{$invoice->order->customer->middle_name ?? ''}}<br>
                                            {{$invoice->order->address}}<br>
                                            <abbr title="Phone">Номер телефона:</abbr> {{$invoice->order->customer->phone_number ?? '_'}}
                                        </address>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive project-invoice">
                                        <table class="table table-bordered mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Товар</th>
                                                <th>Цена</th>
                                                <th>Количество</th>
                                                <th>Итог</th>
                                            </tr><!--end tr-->
                                            </thead>
                                            <tbody>
                                            @foreach($invoice->order->products as $product)
                                                <tr>
                                                    <td>
                                                       {{$product->specifications['name']}}
                                                    </td>
                                                    <td>
                                                        {{$product->specifications['price']}}
                                                    </td>
                                                    <td>
                                                        {{$product->items_count}}
                                                    </td>
                                                    <td>
                                                        {{$product->price_for_count}}
                                                    </td>
                                                </tr><!--end tr-->
                                            @endforeach

                                            </tbody>
                                        </table><!--end table-->
                                    </div>  <!--end /div-->
                                </div>  <!--end col-->
                            </div><!--end row-->


                            <hr>
                            <div class="row d-flex justify-content-center">

                                <div class="col-lg-12">
                                    <div class="float-end">
                                        <form method="POST" action="{{route('invoices.destroy', $invoice)}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-danger trash"
                                                    onclick="return confirm('Удалить запись?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </section>
@endsection
