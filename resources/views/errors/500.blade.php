@extends('layouts.main')
@php
    $title = 'Ошибка 500'
@endphp
@section('content')
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a class="logo logo-admin">
                                        <img src="{{asset('dastone/assets/images/logo-sm-dark.png')}}" height="50" alt="logo" class="auth-logo">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="ex-page-content text-center">
                                    <img src="{{asset('dastone/assets/images/error.svg')}}" alt="0" class="" height="170">
                                    <h1 class="mt-5 mb-4">500!</h1>
                                    <h5 class="font-16 text-muted mb-5">Что-то пошло не так</h5>
                                </div>
                                <a class="btn btn-primary w-100 waves-effect waves-light" href="{{route('home')}}">На главную <i class="fas fa-redo ms-1"></i></a>
                            </div>
                            <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Система управления интернет-магазина © <script>
                                        document.write(new Date().getFullYear())
                                    </script></span>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
@endsection
