@php
    $title = 'Все товары'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все товары</h4>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('products.create')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            <span>Добавить товар</span>
                        </a>
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
                    <th>SKU</th>
                    <th>Артикул</th>
                    <th>Наименование</th>
                    <th>Коллекция атрибутов</th>
                    <th>Статус</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->getKeyValue('sku')}}</td>
                        <td>{{$product->getKeyValue('product_number')}}</td>
                        <td>{{$product->getKeyValue('name')}}</td>
                        <td>{{$product->attributeFamily->name}}</td>
                        <td>
                            @if($product->getKeyValue('status'))
                                <span class="badge rounded-pill bg-success">Активен</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Не активен</span>
                            @endif
                        </td>
                        <td>
                            {{$product->getKeyValue('price') ?? 0}} <i class="mdi mdi-currency-rub"></i>
                        </td>
                        <td>
                            {{$product->quantity}}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('products.destroy', $product)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('products.edit', $product)}}" class="text-primary"><i data-feather="edit"></i></a>
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
