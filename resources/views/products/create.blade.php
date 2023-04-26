@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Добавление товара</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-lg-6">
            <form id="add-product-form" method="POST" action="{{route('products.store')}}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Коллекция атрибутов</label>
                    <select name="attribute_family_id" class="form-select">
                        @foreach($attributeFamilies as $family)
                            <option value="{{$family->id}}">{{$family->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">SKU<span class="text-danger"> *</span></label>
                    <input type="text" name="sku" class="form-control" placeholder="SKU товара">
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="{{route('products.index')}}" class="btn btn-danger">
                    <span>Отмена</span>
                </a>
            </form>
        </div><!--end col-->
    </div> <!-- end row -->

    <script>
        $(function() {
            $("#add-product-form").validate({
                rules: {
                    sku: "required",
                },
                messages:{
                    sku: "Поле обязательно"
                }
            });
        });
    </script>
@endsection
