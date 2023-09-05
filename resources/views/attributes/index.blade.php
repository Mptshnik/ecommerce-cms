@php
    $title = 'Атрибуты'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все атрибуты</h4>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('product-attributes.create')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            <span>Добавить атрибут</span>
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
                    <th>Код</th>
                    <th>Наименование</th>
                    <th>Тип</th>
                    <th>Обязательный</th>
                    <th>Уникальный</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{$attribute->id}}</td>
                        <td>{{$attribute->code}}</td>
                        <td>{{$attribute->label}}</td>
                        <td>{{$attribute->attribute_type_value_fk}}</td>
                        <td>
                            @if($attribute->required)
                                <span class="badge rounded-pill bg-success">Да</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Нет</span>
                            @endif
                        </td>
                        <td>
                            @if($attribute->unique)
                                <span class="badge rounded-pill bg-success">Да</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Нет</span>
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('product-attributes.destroy', $attribute)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('product-attributes.edit', $attribute)}}" class="text-primary"><i
                                            data-feather="edit"></i></a>
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
