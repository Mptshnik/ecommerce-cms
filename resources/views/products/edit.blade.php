@php
    $title = 'Изменение товара'
@endphp
@extends('layouts.main')
@section('content')
    <style>
        .child {
            position: absolute;
            top: 13px;
            left: 30px;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        .parent {
            position: relative;
        }
    </style>
    @include('components.toastr.toast')
    <form id="update-product-form" method="POST" action="{{route('products.update', $product)}}"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Изменение товара</h4>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-2"></i>
                                <span>Сохранить</span>
                            </button>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card report-card">
                    <div class="card-header">
                        <div class="fs-5">
                            Заполнение формы
                        </div>
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="card-body">
                            <div class="col-lg-6">
                                @foreach($product->attributeFamily->attributes as $attribute)
                                    @include("components.attributes." . $attribute->attribute_type_value_fk,
                                                                                  ['attribute' => $attribute,
                                                                                  'data' => $product->getKeyValue($attribute->code)
                                                                                  ])
                                @endforeach
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-body-->
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h5 class="accordion-header m-0" id="inventories">
                            <button class="accordion-button collapsed  fw-semibold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseImages"
                                    aria-expanded="true" aria-controls="collapseImages">
                                Изображения
                            </button>
                        </h5>
                        <div id="collapseImages"
                             class="accordion-collapse collapse"
                             aria-labelledby="inventories" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if($product->images->count() === 0)
                                    <input type="file" name="images[]" class="dropify" multiple accept="image/*"/>
                                @else
                                    <input type="file" name="images[]" class="dropify"
                                           multiple accept="image/*" data-height="100"/>
                                    <div class="row row-cols-3">
                                        @foreach($product->images as $index => $image)
                                            <div class="col-auto">
                                                <div class="parent mt-2">
                                                    <img class="product-image"
                                                         src="{{\Illuminate\Support\Facades\Storage::url($image->url)}}"
                                                    >
                                                    <div class="child">
                                                        <a href="{{route('product-image.delete', $image)}}"
                                                           onclick="return confirm('Удалить изображение?')"
                                                           class="btn btn-sm btn-danger">Удалить</a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h5 class="accordion-header m-0" id="inventories">
                            <button class="accordion-button collapsed  fw-semibold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseInventories"
                                    aria-expanded="true" aria-controls="collapseInventories">
                                Инвентаризация
                            </button>
                        </h5>
                        <div id="collapseInventories"
                             class="accordion-collapse collapse"
                             aria-labelledby="inventories" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach($inventories as $inventory)
                                    <div class="col-lg-6 mt-3">
                                        <label class="form-label">{{$inventory->name}}</label>
                                        @php
                                            $qty = $product->inventories()->where('code', $inventory->code)->first()?->pivot->quantity ?? 0;
                                        @endphp
                                        <input class="form-control" name="{{$inventory->code}}"
                                               value="{{$qty}}"
                                               min="0" step="1" type="number">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h5 class="accordion-header m-0" id="categories">
                            <button class="accordion-button collapsed  fw-semibold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategories"
                                    aria-expanded="true" aria-controls="collapseCategories">
                                Категории
                            </button>
                        </h5>
                        <div id="collapseCategories"
                             class="accordion-collapse collapse"
                             aria-labelledby="inventories" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="col-lg-6">
                                    <ul style="list-style-type: none">
                                        <li>
                                            <i data-feather="folder"></i>
                                            <label class="fs-5">{{ $rootCategory->name }}</label>
                                            @include('categories.partials.check-subcategories', ['categories' => $rootCategory->childCategories])
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div> <!-- end row -->
    </form>
    <script>
        $(function () {
            $("#update-product-form").validate({
                rules: {
                    @foreach($codes as $code)
                    "{{$code}}": 'required',
                    @endforeach
                },
                messages: {
                    @foreach($codes as $code)
                    "{{$code}}": {
                        required: 'Поле обязательно',
                    },
                    @endforeach

                }
            });
        });
    </script>

@endsection
