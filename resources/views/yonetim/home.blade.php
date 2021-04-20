@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - Ana Sayfa')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Genel Bakış</h1>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $todays_orders }}</h3>
                        <p>Günün Siparişleri</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('yonetim.orders_all') }}" class="small-box-footer">Siparişlere Git <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>₺{{ number_format($todays_ciro,2,',','.') }}</h3>

                        <p>Günün Cirosu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('yonetim.orders_all') }}" class="small-box-footer">Satışlara Git <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_user }}</h3>

                        <p>Kayıtlı Kullanıcı</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('yonetim.users') }}" class="small-box-footer">Kullanıcılara Git <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_blog }}</h3>
                        <p>Blog Yazısı</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Blog Git <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Son Siparişler</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Sipariş No</th>
                                <th>Sipariş Veren</th>
                                <th>Tarih</th>
                                <th>Durum</th>
                                <th>Tutar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($last_orders as $last_order)
                                <tr>
                                    <td>{{ $last_order->orderno }}</td>
                                    <td>{{ $last_order->name }} {{ $last_order->surname }}</td>
                                    <td>{{ $last_order->orderdate }}</td>
                                    <td>{{ $last_order->description }}</td>
                                    <td>₺{{ number_format($last_order->totalprice,2,',','.') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ürün Satışları</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                               <th>ID</th>
                               <th>Ürün</th>
                               <th>Gramaj</th>
                               <th>Adet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urunler as $urun)
                                <tr>
                                    <td>{{ $urun->id }}</td>
                                    <td>{{ $urun->name }}</td>
                                    <td>{{ $urun->weight }}</td>
                                    <td>
                                        @php
                                         $item = DB::table('basket_item')
                                                ->where('basket_item.ref_basket','!=',null)
                                                ->where('basket_item.ref_product','=', $urun->id)
                                                ->GroupBy('basket_item.ref_product')
                                                ->Sum('basket_item.quantity');
                                         echo $item;
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- Control Sidebar -->
@endsection

