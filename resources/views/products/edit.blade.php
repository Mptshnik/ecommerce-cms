@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <form id="update-product-form" method="POST" action="{{route('products.update', $product)}}">
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
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-2">
                    @foreach($product->attributeFamily->groups as $group)
                        <div class="col-lg-6">
                            <div class="card report-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        {{$group->name}}
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body">
                                    @foreach($group->attributes as $attribute)
                                        @include("components.attributes." . $attribute->attribute_type_value_fk,
                                            ['attribute' => $attribute,
                                            'data' => $product->getKeyValue($attribute->code)
                                            ])
                                    @endforeach
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->

                    @endforeach
                </div>
                <div class="accordion" id="accordionExample">
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
        $(function() {
            $("#update-product-form").validate({
                rules: {
                    @foreach($codes as $code)
                        "{{$code}}" : 'required',
                    @endforeach
                },
                messages:{
                    @foreach($codes as $code)
                    "{{$code}}" : 'Поле обязательно',
                    @endforeach

                }
            });
        });
    </script>

@endsection
