@php
    $title = 'Добавление категории'
@endphp
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Добавление категории</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-12">
            <form id="add-category-form" method="POST" action="{{route('categories.store')}}">
                @csrf
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Общее
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Наименование<span class="text-danger"> *</span></label>
                                    <input type="text" id="nameInput" name="name" class="form-control"
                                           placeholder="Название категории">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Отображается в меню</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1"
                                               name="visible_in_menu">
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Описание
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <label class="form-label">Краткое описание</label>
                                <textarea class="form-control"
                                          name="description"
                                          rows="3"></textarea>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->

                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Родительская категория
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <ul style="list-style-type: none">
                                    <li>
                                        <div class="radio radio-primary">
                                            <i data-feather="folder"></i>
                                            <input type="radio" name="category_id" value="{{ $rootCategory->id }}"
                                                   id="category{{ $rootCategory->id }}">
                                            <label class="fs-5"
                                                   for="category{{ $rootCategory->id }}">{{ $rootCategory->name }}</label>
                                        </div>
                                        @include('categories.partials.radio-subcategories', ['categories' => $rootCategory->childCategories])
                                    </li>
                                </ul>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="{{route('categories.index')}}" class="btn btn-danger">
                    <span>Отмена</span>
                </a>
            </form>
        </div><!--end col-->
    </div> <!-- end row -->

    <script>
        $(function () {
            $("#add-category-form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Поле обязательно",
                }
            });
        });
    </script>
@endsection
