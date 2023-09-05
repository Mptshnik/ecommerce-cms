@php
    $title = 'Главная'
@endphp
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Главная</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <a href="{{route('orders.index')}}">
                    <div class="col-md-6 col-lg-10">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Заказы</p>
                                        <h3 class="m-0">{{\App\Models\Order::all()->count()}}</h3>
                                        <p class="mb-0 text-truncate text-muted">Всего заказов в системе</p>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="report-main-icon bg-light-alt">
                                            <i data-feather="truck" class="align-self-center text-muted icon-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </a>
                <a href="{{route('products.index')}}">
                    <div class="col-md-6 col-lg-10">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Товары</p>
                                        <h3 class="m-0">{{\App\Models\Product::all()->count()}}</h3>
                                        <p class="mb-0 text-truncate text-muted">Всего товаров в системе</p>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="report-main-icon bg-light-alt">
                                            <i data-feather="package" class="align-self-center text-muted icon-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div>
                </a>
                <a href="{{route('categories.index')}}">
                    <div class="col-md-6 col-lg-10">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Категории</p>
                                        <h3 class="m-0">{{\App\Models\Category::all()->count()}}</h3>
                                        <p class="mb-0 text-truncate text-muted">Всего категорий в системе</p>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="report-main-icon bg-light-alt">
                                            <i data-feather="list" class="align-self-center text-muted icon-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </a>
               <a href="{{route('users.index')}}">
                   <div class="col-md-6 col-lg-10">
                       <div class="card report-card">
                           <div class="card-body">
                               <div class="row d-flex justify-content-center">
                                   <div class="col">
                                       <p class="text-dark mb-0 fw-semibold">Пользователи</p>
                                       <h3 class="m-0">{{\App\Models\User::all()->count()}}</h3>
                                       <p class="mb-0 text-truncate text-muted">Всего пользователей в системе</p>
                                   </div>
                                   <div class="col-auto align-self-center">
                                       <div class="report-main-icon bg-light-alt">
                                           <i data-feather="users" class="align-self-center text-muted icon-sm"></i>
                                       </div>
                                   </div>
                               </div>
                           </div><!--end card-body-->
                       </div><!--end card-->
                   </div> <!--end col-->
               </a>
            </div><!--end row-->
        </div><!--end col-->
    </div><!--end row-->
    <script>

    </script>
@endsection
