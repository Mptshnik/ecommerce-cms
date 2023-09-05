<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App css -->
    <link href="{{asset('dastone/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>

    <script src="{{asset('dastone/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('dastone/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('dastone/assets/js/jquery.validate.js')}}"></script>

    <link href="{{asset('dastone/plugins/toastr/toastr.css')}}" rel="stylesheet"/>
</head>
<body>
@include('components.toastr.toast')
<div class="container">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card">
                        <div class="card-body p-0 auth-header-box">
                            <div class="text-center p-3">
                                <img src="{{asset('dastone/assets/images/logo-sm-dark.png')}}" height="50" alt="logo"
                                     class="auth-logo">
                                <p class="mb-0 mt-2">Авторизуйтесь, чтобы войти в систему</p>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form class="form-horizontal auth-form" id="auth-form" method="post"
                                  action="{{route('authorize')}}">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="Введите email">
                                </div><!--end form-group-->

                                <div class="mb-2">
                                    <label class="form-label">Пароль</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Введите пароль">
                                </div><!--end form-group-->

                                <div class="form-group row my-3">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch switch-success">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                   id="customSwitchSuccess">
                                            <label class="form-label text-muted" for="customSwitchSuccess">Запомнить
                                                меня</label>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-sm-6 text-end">
                                        <a href="{{route('password.request')}}" class="text-muted font-13"><i
                                                class="dripicons-lock"></i> Забыли пароль?</a>
                                    </div><!--end col-->
                                </div><!--end form-group-->

                                <div class="form-group mb-0 row">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                                            Войти <i class="fas fa-sign-in-alt ms-1"></i></button>
                                    </div><!--end col-->
                                </div> <!--end form-group-->
                            </form><!--end form-->
                        </div><!--end card-body-->
                        <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Система управления интернет магазина © <script>
                                        document.write(new Date().getFullYear())
                                    </script></span>
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<script src="{{asset('dastone/assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('dastone/plugins/toastr/toastr.min.js')}}"></script>

<script>
    $(function () {
        $("#auth-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
                password: {
                    required: true,
                    maxlength: 255
                }
            },
            messages: {
                email: {
                    required: "Введите email",
                    email: "Введите корректный email",
                    maxlength: "Максимальная длина email 255 символов"
                },
                password: {
                    required: "Введите пароль",
                    maxlength: "Максимальная длина пароля 255 символов"
                }
            }
        });
    });
</script>

</body>
</html>

