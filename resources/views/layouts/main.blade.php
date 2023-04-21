<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">

            </li>

            <!-- Messages Dropdown Menu -->
            {{-- <li class="nav-item dropdown">
                 <a class="nav-link" data-toggle="dropdown" href="#">
                     <i class="far fa-comments"></i>
                     <span class="badge badge-danger navbar-badge">3</span>
                 </a>
             </li>
             <!-- Notifications Dropdown Menu -->
             <li class="nav-item dropdown mr-2">
                 <a class="nav-link" data-toggle="dropdown" href="#">
                     <i class="far fa-bell"></i>
                     <span class="badge badge-warning navbar-badge">15</span>
                 </a>
             </li>--}}
            <!-- Logout -->
            <li class="nav-item dropdown mr-3 mt-1">
                <form action="#" method="post">
                    @csrf
                    <button class="text-secondary" style="background: transparent; border: 0" type="submit">Выход <i
                            class="fas fa-sign-out-alt"></i></button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Магазин</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-signal"></i>
                            <p>
                                Продажи
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Заказы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Возвраты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Счета</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-list-ul"></i>
                            <p>
                                Каталог
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Товары</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Категории</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">

                                    <p>Атрибуты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">

                                    <p>Коллекции атрибутов</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                Покупатели
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Покупатели</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Отзывы</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <p>
                                Конфигурация
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Email</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <p>Продажи</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-shield"></i>
                            <p>Пользователи</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019-{{now()->year}} <a href="/">Магазин</a>.</strong>
        Все права защищены.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>
<script>
    function clearFilters() {
        var url = window.location.href.split("?")[0];
        history.pushState({path: url}, '', url);
        window.location.href = window.location.href;
    }
</script>
<script>
    $(document).ready(function () {
        $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
<script>
    $(function () {
        $("#index-table, #table-paging1, #table-paging2").DataTable({
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
            "drawCallback": function () {

            }
        });
    });

    $(function () {
        $("").DataTable({
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
            "drawCallback": function () {

            }
        });
    });
</script>
</body>
</html>
