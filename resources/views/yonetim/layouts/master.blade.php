<!DOCTYPE html>
<html lang="TR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('yonetim.home') }}" class="nav-link">Ana Sayfa</a>
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                <form id="logout-form" action="{{ route('yonetim.logout_action') }}" method="post" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('yonetim.home') }}" class="brand-link">
            <img src="/images/footer-logo.png">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('yonetim.home') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Genel Bakış</p>
                        </a>
                    </li>
                    <li class="nav-header">Siparişler<?php
                        $item = DB::table('order')->Count();
                        echo " (" . $item .")";
                        ?></li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_all') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Siparişler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('order.ref_orderstatus','!=',6)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_preparing') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Hazırlanacaklar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',1)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_waiting') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Ödeme Bekleyenler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',2)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_send') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Bu Gün Gönderilecekler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',3)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_shipped') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Kargoya Verilenler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',4)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_completed') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tamamlanmış Siparişler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',5)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.orders_cancelled') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>İptal Edilenler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')->Where('ref_orderstatus',6)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">
                        Satışlar<?php
                        $item = DB::table('order')
                            ->Count();
                        echo " (" . $item .")";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.statistics') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Satışlar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')
                                        ->where('ref_orderstatus','!=',6)
                                        ->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.statistics_credit_cart') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Kredi Kartı<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')
                                        ->Where('ref_paymentmethod','=',1)
                                        ->where('ref_orderstatus','!=',6)
                                        ->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.statistics_transfer') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Havale/Eft<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')
                                        ->Where('ref_paymentmethod','=',2)
                                        ->where('ref_orderstatus','!=',6)
                                        ->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.statistics_cash') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Kapıda Nakit<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')
                                        ->Where('ref_paymentmethod','=',3)
                                        ->where('ref_orderstatus','!=',6)
                                        ->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.statistics_cancelled') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>İptal Edilen<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('order')
                                        ->where('ref_orderstatus','=',6)
                                        ->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">
                        Kullanıcılar<?php
                        $item = DB::table('user')
                            ->Count();
                        echo " (" . $item .")";
                        ?></li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.users') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Kullanıcılar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('user')->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.users_active') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Aktif Kullanıcılar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('user')->Where('active',true)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.users_passive') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Pasif Kullanıcılar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('user')->Where('active',false)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">
                        Ürünler<?php
                        $item = DB::table('product')
                            ->Count();
                        echo " (" . $item .")";
                        ?></li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.products') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Ürünler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product')->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.products_active') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Aktif Ürünler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product')->Where('active',true)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.products_passive') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Pasif Ürünler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product')->Where('active',false)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">Kategoriler
                        <?php
                        $item = DB::table('category')->Count();
                        echo "(" . $item . ")";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Kategoriler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('category')->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Aktif Kategoriler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('category')->Where('active',true)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Pasif Kategoriler<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('category')->Where('active',false)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">Blog Konuları
                        <?php
                        $item = DB::table('blog')->Count();
                        echo "(" . $item . ")";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Konular<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('blog')->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Aktif Konular<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('blog')->Where('active',true)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Pasif Konular<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('blog')->Where('active',false)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-header">Blog Yorumları
                        <?php
                        $item = DB::table('product_vote')->Count();
                        echo "(" . $item . ")";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.all_votes') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Tüm Yorumlar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product_vote')->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.active_votes') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Aktif Yorumlar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product_vote')->Where('active',true)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('yonetim.passive_votes') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Pasif Yorumlar<span class="badge badge-info right">
                                    <?php
                                    $item = DB::table('product_vote')->Where('active',false)->Count();
                                    echo $item;
                                    ?>
                                </span></p>
                        </a>
                    </li>
                </ul>
                <br/>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    @yield('content')
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
</body>
</html>
