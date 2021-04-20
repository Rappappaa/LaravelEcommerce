@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - Satışlar')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Tüm Satışlar -->
        <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $pagetitle }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{ route('yonetim.statistic_filter') }}" METHOD="POST">
                            {{ csrf_field() }}
                        <div class="row" style="float: right;">
                            <div class="form-group">
                                <select class="form-control select2" style="width:100px;" id="yil" name="yil">
                                    @for($i = 2020; $i<2030; $i++)
                                        <option value="{{ $i }}"
                                        @if($i == $yil)
                                            {{ "selected" }}
                                            @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            &nbsp;
                            <div class="form-group">
                                <select class="form-control select2" style="width:200px;" id="ay" name="ay">
                                    @for($i = 1; $i<13; $i++)
                                        <option value="{{ $i }}"
                                        @if($ay == $aylar[$i])
                                            {{ "selected" }}
                                            @endif>{{ $aylar[$i] }}</option>
                                    @endfor
                                </select>
                            </div>
                            &nbsp;
                            <div class="form-group">
                                <button class="btn btn-primary sm">Filtrele</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon ic bg-info"><i class="fas fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kredi Kartı <span class="text-muted">({{ $toplamkredikarticirosuadet }} işlem)</span></span>
                            <span class="info-box-number" style="font-size: 24px">₺{{ number_format($toplamkredikarticirosu,2,',','.') }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-university" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Havale/Eft <span class="text-muted">({{ $toplambankacirosuadet }} işlem)</span></span>
                            <span class="info-box-number" style="font-size: 24px">₺{{ number_format($toplambankacirosu,2,',','.') }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">₺</span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kapıda Nakit <span class="text-muted">({{ $toplamnakitciroadet }} işlem)</span></span>
                            <span class="info-box-number" style="font-size: 24px">₺{{ number_format($toplamnakitciro,2,',','.') }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-globe" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Toplam Ciro <span class="text-muted">({{ $toplamciroadet }} işlem)</span></span>
                            <span class="info-box-number" style="font-size: 24px">₺{{ number_format($toplamciro,2,',','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
        </section>
        <!-- Aylık Satışlar -->
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $yil }} {{ $ay }} Ayı Satışları</h1>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon ic bg-info"><i class="fas fa-credit-card"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kredi Kartı <span class="text-muted">({{ $aylikkredikartiadet }} işlem)</span></span>
                                <span class="info-box-number" style="font-size: 24px">₺{{ number_format($aylikkredikarti,2,',','.') }}
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-university" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Havale/Eft <span class="text-muted">({{ $aylikbankatransferiadet }} işlem)</span></span>
                                <span class="info-box-number" style="font-size: 24px">₺{{ number_format($aylikbankatransferi,2,',','.') }}
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">₺</span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kapıda Nakit <span class="text-muted">({{ $ayliknakitadet }} işlem)</span></span>
                                <span class="info-box-number" style="font-size: 24px">₺{{ number_format($ayliknakit,2,',','.') }}
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-globe" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Aylık Toplam <span class="text-muted">({{ $ayliktoplamadet }} işlem)</span></span>
                                <span class="info-box-number" style="font-size: 24px">₺{{ number_format($ayliktoplam,2,',','.') }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 20%;">
                                    Tarih
                                </th>
                                <th style="width: 20%;">
                                    Kredi Kartı
                                </th>
                                <th style="width: 20%;">
                                    Banka
                                </th>
                                <th style="width: 20%;">
                                    Nakit
                                </th>
                                <th style="width: 20%;">
                                    Toplam
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gunler as $gun)
                                <tr>
                                    <td>{{ $gun }}</td>
                                    <td><?php
                                        $a = DB::table('order')
                                            ->where('ref_orderstatus','!=',6)
                                            ->where('ref_paymentmethod','=',1)
                                            ->Where(DB::raw('DATE(orderdate)'),'=',$gun)
                                            ->Sum('totalprice');
                                        if($a>0){
                                            echo "₺" . number_format($a,2,',','.');
                                        }else{
                                            echo "---";
                                        }
                                    ?></td>
                                    <td><?php
                                        $b = DB::table('order')
                                            ->where('ref_orderstatus','!=',6)
                                            ->where('ref_paymentmethod','=',2)
                                            ->Where(DB::raw('DATE(orderdate)'),'=',$gun)
                                            ->Sum('totalprice');
                                        if($b>0){
                                            echo "₺" . number_format($b,2,',','.');
                                        }else{
                                            echo "---";
                                        }
                                        ?></td>
                                    <td><?php
                                        $c = DB::table('order')
                                            ->where('ref_orderstatus','!=',6)
                                            ->where('ref_paymentmethod','=',3)
                                            ->Where(DB::raw('DATE(orderdate)'),'=',$gun)
                                            ->Sum('totalprice');
                                        if($c>0){
                                            echo "₺" . number_format($c,2,',','.');
                                        }else{
                                            echo "---";
                                        }
                                        ?></td>
                                    <td><?php
                                        $d = DB::table('order')
                                            ->where('ref_orderstatus','!=',6)
                                            ->Where(DB::raw('DATE(orderdate)'),'=',$gun)
                                            ->Sum('totalprice');
                                        if($d>0){
                                            echo "₺" . number_format($d,2,',','.');
                                        }else{
                                            echo "---";
                                        }
                                        ?></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
