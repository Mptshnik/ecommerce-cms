<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Восстановление пароля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <script src="{{asset('dastone/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('dastone/plugins/toastr/toastr.min.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('dastone/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('dastone/plugins/toastr/toastr.css')}}" rel="stylesheet"/>

    <link href="{{asset('dastone/assets/css/custom-styles.css')}}" rel="stylesheet">
</head>

<body class="account-body accountbg">

<!-- Recover-pw page -->
<div class="container">
    @include('components.toastr.toast')
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card">
                        <div class="card-body p-0 auth-header-box">
                            <div class="text-center p-3">
                                <a href="#" class="logo logo-admin">
                                    <img src="{{asset('dastone/assets/images/logo-sm-dark.png')}}" height="50"
                                         alt="logo" class="auth-logo">
                                </a>
                                <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Восстановление пароля</h4>
                                <p class="text-muted  mb-0">Введите email, чтобы вам на почту пришло письмо с
                                    восстановленим пароля</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="reset-password" class="form-horizontal auth-form" method="post" action="{{route('password.email')}}">
                                @csrf
                                <div class="form-group mb-2">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Введите email">
                                </div><!--end form-group-->

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                                            Отправить <i class="fas fa-sign-in-alt ms-1"></i></button>
                                    </div><!--end col-->
                                </div> <!--end form-group-->
                            </form><!--end form-->
                            <p class="text-muted mb-0 mt-3">Вспомнили пароль ? <a href="{{route('login')}}"
                                                                                  class="text-primary ms-2">Авторизация</a>
                            </p>
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<!-- End Recover-pw page -->

<script src="{{asset('dastone/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/feather.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/waves.js')}}"></script>

<script src="{{asset('dastone/assets/js/jquery.validate.js')}}"></script>
<script>
    $(function () {
        $("#reset-password").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
            },
            messages: {
                email: {
                    required: "Введите email",
                    email: "Введите корректный email",
                    maxlength: "Максимальная длина email 255 символов"
                },
            }
        });
    });
</script>
</body>

</html>
