@php
    $title = 'Добавление пользователя'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-lg-6 col-xl-6 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Добавление пользователя</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body">
                    <form id="user-form" method="post" action="{{route('users.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email">
                            @error('email')
                                <label class="text-danger" style="font-size: 11px">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Имя пользователя <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Фото профиля</label>

                            <input type="file" id="input-file-now" class="dropify" accept="image/*" name="profile_image"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Пароль <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Введите пароль"
                                   id="password"
                                   name="password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Повторите пароль <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Повторите пароль"
                                   id="confirm_password"
                                   name="confirm_password">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-outline-danger">
                                Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!--end col-->
    </div><!--end row-->
    <script>
        $(function () {
            $("#user-form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email:{
                        required: true,
                        maxlength: 255,
                        email:true
                    },
                    password: {
                        required: true,
                        maxlength: 255,
                        minlength: 6,
                    },
                    confirm_password: {
                        required: true,
                        maxlength: 255,
                        equalTo: '#password',
                        minlength: 6,
                    },
                },
                messages: {
                    email:{
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов",
                        email: "Поле должно содержать email"
                    },
                    name: {
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов"
                    },
                    password: {
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов",
                        minlength: "Минимальная длина пароля 6 символов"
                    },
                    confirm_password: {
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов",
                        equalTo: "Пароли не совпадают",
                        minlength: "Минимальная длина пароля 6 символов"
                    },
                }
            });
        });
    </script>
@endsection
