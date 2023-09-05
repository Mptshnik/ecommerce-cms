@php
    $title = 'Профиль'
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
                            <h4 class="card-title">Персональная информация</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body">
                    <form id="user-form" method="post" action="{{route('profile.update')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input class="form-control" disabled
                                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Имя пользователя <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Фото профиля</label>

                            <input type="file" id="input-file-now" class="dropify" accept="image/*" name="profile_image"
                                   data-default-file="{{\Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()
                                ->profile_image)}}"/>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-outline-danger">
                                Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!--end col-->
        <div class="col-lg-6 col-xl-6 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Изменение пароля</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form id="password-form" method="post" action="{{route('password.change')}}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Текущий пароль <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Пароль" name="old_password">
                            @error('mismatch')<label class="error">{{$message}}</label>@enderror
                            <a href="{{route('profile.forgot-password')}}" class="text-primary font-12">Забыли пароль ?</a>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Новый пароль <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Введите новый пароль"
                                   id="new_password"
                                   name="new_password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Повторите пароль <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" placeholder="Введите новый пароль еще раз"
                                   id="confirm_password"
                                   name="confirm_password">
                            <span class="form-text text-muted font-12">Никому не сообщайте свой пароль.</span>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Изменить пароль</button>
                                <button type="button" onclick="window.history.back()"
                                        class="btn btn-sm btn-outline-danger">Отмена
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div><!--end row-->
    <script>
        $(function () {
            $("#user-form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                },
                messages: {
                    name: {
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов"
                    },
                }
            });
            $("#password-form").validate({
                rules: {
                    old_password: {
                        required: true,
                        maxlength: 255
                    },
                    new_password: {
                        required: true,
                        maxlength: 255,
                        minlength: 6,
                    },
                    confirm_password: {
                        required: true,
                        maxlength: 255,
                        equalTo: '#new_password',
                        minlength: 6,
                    },
                },
                messages: {
                    old_password: {
                        required: "Поле обязательно",
                        maxlength: "Максимальная длина поля 255 символов"
                    },
                    new_password: {
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
