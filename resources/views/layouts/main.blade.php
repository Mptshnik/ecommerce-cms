<!DOCTYPE html>
<html lang="en">

<head>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dastone/assets/images/favicon.ico')}}">
    <meta charset="utf-8"/>
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <script src="{{asset('dastone/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('dastone/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('dastone/assets/js/metismenu.min.js')}}"></script>


    <!-- DataTables -->
    <link href="{{asset('dastone/plugins/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dastone/plugins/datatables/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{asset('dastone/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('dastone/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">

    <!-- App css -->
    <link href="{{asset('dastone/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dastone/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('dastone/plugins/toastr/toastr.css')}}" rel="stylesheet"/>

    <link href="{{asset('dastone/assets/css/custom-styles.css')}}" rel="stylesheet">
    <!-- Select -->
    <link href="{{asset('dastone/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('dastone/plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
</head>

<body class="">

<!-- Left Sidenav -->
<div class="left-sidenav">

    <!-- LOGO -->
    <div class="brand">
        <a href="/" class="logo">
            <span>
                <img src="{{asset('dastone/assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>
            <span>
                <img src="{{asset('dastone/assets/images/logo.png')}}" alt="logo-large"
                     class="logo-lg logo-light">
                <img src="{{asset('dastone/assets/images/logo-dark.png')}}" alt="logo-large"
                     class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="{{route('home')}}"> <i data-feather="home"
                                                                 class="align-self-center menu-icon"></i>Главная</a>
            </li>
            <li>
                <a href="#"> <i data-feather="bar-chart-2"
                                class="align-self-center menu-icon"></i><span>Продажи</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{route('orders.index')}}"><i class="ti-control-record"></i>Заказы</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('refunds.index')}}"><i class="ti-control-record"></i>Возвраты</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('invoices.index')}}"><i class="ti-control-record"></i>Счета</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"> <i data-feather="list" class="align-self-center menu-icon"></i><span>Каталог</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{route('products.index')}}"><i
                                class="ti-control-record"></i>Товары</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('categories.index')}}"><i
                                class="ti-control-record"></i>Категории</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('product-attributes.index')}}"><i
                                class="ti-control-record"></i>Атрибуты</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('attribute-families.index')}}"><i
                                class="ti-control-record"></i>Коллеции атрибутов</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"> <i data-feather="user" class="align-self-center menu-icon"></i><span>Клиенты</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{route('customers.index')}}"><i class="ti-control-record"></i>Все
                            покупатели</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('reviews.index')}}"><i class="ti-control-record"></i>Отзывы</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"> <i data-feather="tool"
                                class="align-self-center menu-icon"></i><span>Конфигурация</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    {{--<li class="nav-item"><a class="nav-link" href="#"><i class="ti-control-record"></i>Электронная почта</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="ti-control-record"></i>Продажи</a>
                    </li>--}}
                    <li class="nav-item"><a class="nav-link" href="{{route('inventories.index')}}"><i
                                class="ti-control-record"></i>Склады</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{route('users.index')}}"> <i data-feather="users" class="align-self-center menu-icon"></i>Пользователи</a>
            </li>
        </ul>

    </div>
</div>
<!-- end left-sidenav-->


<div class="page-wrapper">
    <!-- Прелоадер -->

    <!-- Top Bar Start -->
    <div class="topbar">
        <div class="preloader">
            <div class="preloader__row">
                <div class="preloader__item"></div>
                <div class="preloader__item"></div>
            </div>
        </div>
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">


                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown"
                       href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <span class="ms-1 nav-user-name">

                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </span>
                        <img
                            src="{{\Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()
                                ->profile_image)}}"
                            alt="profile-user"
                            class="rounded-circle thumb-xs"/>
                        @endif

                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('profile')}}"><i data-feather="user"
                                                                                class="align-self-center icon-xs icon-dual me-1"></i>
                            Профиль</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="power"
                                                                               class="align-self-center icon-xs icon-dual me-1"></i>
                            Выход</a>
                    </div>
                </li>
            </ul><!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile">
                        <i data-feather="menu" class="align-self-center topbar-icon"></i>
                    </button>
                </li>

            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            @yield('content')
        </div><!-- container -->

        <footer class="footer text-center text-sm-start">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            Dastone
        </footer><!--end footer-->
    </div>
    <!-- end page content -->
</div>
<script>
    $(window).on('load', function () {
        $('.preloader').fadeOut().end().delay(400).fadeOut('slow');
    });
</script>
<!-- end page-wrapper -->
<!-- jQuery  -->
<script src="{{asset('dastone/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/feather.min.js')}}"></script>
<script src="{{asset('dastone/assets/js/simplebar.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('dastone/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/dataTables.bootstrap5.min.js')}}"></script>

<!-- Buttons -->
<script src="{{asset('dastone/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/buttons.colVis.min.js')}}"></script>

<!-- Responsive -->
<script src="{{asset('dastone/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dastone/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('dastone/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('dastone/assets/js/waves.js')}}"></script>

<script src="{{asset('dastone/assets/js/jquery.validate.js')}}"></script>

<!-- Moment -->
<script src="{{asset('dastone/assets/js/moment.js')}}"></script>

<script src="{{asset('dastone/assets/js/ru.js')}}"></script>

<!-- Select -->
<script src="{{asset('dastone/plugins/select2/select2.min.js')}}"></script>

<script src="{{asset('dastone/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>

<script src="{{asset('dastone/plugins/dropify/js/dropify.min.js')}}"></script>

<script src="{{asset('dastone/assets/js/jquery.form-upload.init.js')}}"></script>
<!-- App js -->
<script src="{{asset('dastone/assets/js/app.js')}}"></script>
<script>
    $('.select2').select2({
        theme: "classic"
    });

    $('.min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm', minDate: new Date(), lang: 'ru',
        clearButton: 'Очистить', cancelText: 'Отмена', locale: 'ru'
    });
</script>

<script>

    $.validator.addMethod("nowhitespace", function(value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "Введите текст без пробелов");

    $(function () {
        $("#customer-reviews, #customer-orders").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "lengthMenu": [
                [5, 10, 15],
                [5, 10, 15],
            ],
            "lengthChange": true,
            "info": false,
            "language": {
                "zeroRecords": 'По вашему запросу ничего не найдено',
                "infoEmpty": 'Пока нет данных',
                "search": 'Поиск:',
                "lengthMenu": 'Отображать по _MENU_ записей',
                "paginate": {"previous": "<", "next": ">"}
            },
        });
    });
    $(function () {
        $("#inventories-table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "language": {
                "zeroRecords": 'По вашему запросу ничего не найдено',
                "infoEmpty": 'Пока нет данных',
                "search": 'Поиск:'
            },
        });
    });
    $(function () {
        $("#datatable-buttons").DataTable({
            "responsive": true,
            "lengthMenu": [
                [5, 10, 15],
                [5, 10, 15],
            ],
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "info": false,
            "language": {
                "zeroRecords": 'По вашему запросу ничего не найдено',
                "infoEmpty": 'Пока нет данных',
                "search": 'Поиск:',
                "lengthMenu": 'Отображать по _MENU_ записей',
                "paginate": {"previous": "<", "next": ">"}
            },

            "dom": 'lfBrtip',
            "buttons": [
                {
                    extend: 'copy',
                    text: 'Копировать',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'print',
                    text: 'Печать',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: 'Каталог товаров',
                },
                {
                    extend: 'colvis',
                    text: 'Скрыть столбцы',
                    className: 'btn btn-dark'
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: 'Каталог товаров',
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: 'Каталог товаров',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: 'Каталог товаров',
                },
            ],

        });
    });
</script>
</body>

</html>
