@php
    $title = 'Добавление коллекции атрибутов'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <form id="add-attribute-family-form" method="POST" action="{{route('attribute-families.store')}}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Добавление коллекции атрибутов</h4>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
                <div class="card report-card">
                    <div class="card-header">
                        <div class="fs-5">
                            Общее
                        </div>
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Наименование<span class="text-danger"> *</span></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Код<span class="text-danger"> *</span></label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Добавить атрибуты</label>
                            <select class="select2 form-control" name="attribute_ids[]" multiple="multiple">
                                @foreach($attributes as $attribute)
                                    <option value="{{$attribute->id}}">{{$attribute->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                            <a href="{{route('attribute-families.index')}}" class="btn btn-danger">
                                <span>Отмена</span>
                            </a>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
        </div>

    </form>
    <script>


        $(function () {
            $("#add-attribute-family-form").validate({
                rules: {
                    name: "required",
                    code: {
                        required: true,
                        nowhitespace:true
                    },
                },
                messages: {
                    name: "Поле обязательно",
                    code: {
                        required: "Поле обязательно",
                        nowhitespace: "Поле не должно содержать пробелы"
                    },
                }
            });
        });
    </script>

@endsection
