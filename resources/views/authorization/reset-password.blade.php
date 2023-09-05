
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Восстановление пароля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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

<!-- Log In page -->
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
                                    <img src="{{asset('dastone/assets/images/logo-sm-dark.png')}}" height="50" alt="logo" class="auth-logo">
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-3">
                                <form class="form-horizontal auth-form" id="reset-password" method="post" action="{{route('password.update')}}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="new_password">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               value="{{$user_email}}"
                                               placeholder="Введите email">
                                    </div><!--end form-group-->
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="password">Новый пароль</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Введите новый пароль">
                                    </div><!--end form-group-->
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="password_confirmation">Повторите новый пароль</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Введите новый пароль еще раз">
                                    </div><!--end form-group-->
                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Сохранить <i class="fas fa-sign-in-alt ms-1"></i></button>
                                        </div><!--end col-->
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<!-- End Log In page -->



<script src="{{asset('dastone/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/feather.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/waves.js')}}"></script>

<script src="{{asset('dastone/assets/js/jquery.validate.js')}}"></script>
<script>
    $(function () {
        $("#reset-password").validate({
            rules: {
                password: {
                    required: true,
                    maxlength: 255,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    maxlength: 255,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            messages: {
                password: {
                    required: "Введите новый пароль",
                    maxlength: "Максимальная длина пароля 255 символов",
                    minlength: "Минимальная длина пароля 6 символов"
                },
                password_confirmation: {
                    required: "Повторите новый пароль",
                    maxlength: "Максимальная длина пароля 255 символов",
                    minlength: "Минимальная длина пароля 6 символов",
                    equalTo: "Пароли не совпадают"
                },
            }
        });
    });
</script>

</body>

</html>
