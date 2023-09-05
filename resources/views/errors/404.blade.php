@extends('layouts.main')
@php
    $title = 'Ошибка 404'
@endphp
@section('content')
    <!-- Eror-404 page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="#" class="logo logo-admin">
                                        <img src="{{asset('dastone/assets/images/logo-sm-dark.png')}}" height="50" alt="logo" class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold font-18">Страница не найдена</h4>
                                    <p class="text-muted  mb-0">К сожалению, не удалось найти запрашиваемую информацию</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="ex-page-content text-center">
                                    <img src="{{asset('dastone/assets/images/error.svg')}}" alt="0" class="" height="170">
                                    <h1 class="mt-5 mb-4">404!</h1>
                                    <h5 class="font-16 text-muted mb-5">Что-то пошло не так</h5>
                                </div>
                                <a class="btn btn-primary w-100 waves-effect waves-light" href="{{route('home')}}">Главная <i class="fas fa-redo ms-1"></i></a>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Eror-404 page -->
@endsection

