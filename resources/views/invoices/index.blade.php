@php
    $title = 'Счета'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все счета</h4>
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
                    <th>Номер счета</th>
                    <th>Номер заказа</th>
                    <th>Сумма счета</th>
                    <th>Время формирования счета</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->number}}</td>
                        <td>{{$invoice->order->number}}</td>
                        <td>{{$invoice->order->total_sum}} ₽</td>
                        <td>{{$invoice->updated_at->format('d.m.Y h:i')}}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('invoices.destroy', $invoice)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('invoices.show', $invoice)}}" class="text-primary"><i
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
