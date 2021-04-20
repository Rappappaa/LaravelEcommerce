@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - ' . $pagetitle)
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
                        <form
                            @if($pagetitle == "Kredi Kartı Satışları")
                                action="{{ route('yonetim.statistics_credit_cart_filter') }}"
                            @endif
                            @if($pagetitle == "Havale/Eft Satışları")
                                action="{{ route('yonetim.statistics_transfer_filter') }}"
                            @endif
                            @if($pagetitle == "Kapıda Nakit Satışları")
                                action="{{ route('yonetim.statistics_cash_filter') }}"
                            @endif
                            @if($pagetitle == "İptal Edilen Satışlar")
                            action="{{ route('yonetim.statistics_cancelled_filter') }}"
                            @endif
                            METHOD="POST">
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
                            <span class="info-box-icon ic bg-info">
                                @if($pagetitle == "Kredi Kartı Satışları")
                                <i class="fas fa-credit-card"></i>
                                @endif
                                @if($pagetitle == "Havale/Eft Satışları")
                                <i class="fa fa-university" aria-hidden="true"></i>
                                @endif
                                @if($pagetitle == "Kapıda Nakit Satışları")
                                    ₺
                                @endif
                                @if($pagetitle == "İptal Edilen Satışlar")
                                        <i class="far fa-window-close"></i>
                                @endif
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ $ay }} Ayı İçerisindeki Toplam <span class="text-muted">({{ $ayliktoplamadet }} işlem)</span></span>
                                <span class="info-box-number" style="font-size: 24px">₺{{ number_format($ayliktoplam,2,',','.') }}
                            </span>
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
                                <th style="width: 13%;">
                                    Tarih</th>
                                <th style="width: 12%;">
                                    Sipariş No
                                </th>
                                <th style="width: 20%;">
                                    Siparişi Veren
                                </th>
                                <th style="width: 20%;">
                                    Tarih
                                </th>
                                <th style="width: 20%;">
                                    Tutar
                                </th>
                                <th style="width: 20%;">
                                    Durum
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Count($siparisler)>0)
                            @foreach($gunler as $gun)
                                @foreach($siparisler as $siparis)
                                    <tr>
                                        @if($gun == date('Y-m-d', strtotime($siparis->orderdate)))
                                        <td>{{ $gun }}</td>
                                        <td>
                                            <form action="{{ route('yonetim.order_detail') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="siparisid" name="siparisid" value="{{ $siparis->orderno }}">
                                                <button style="border: transparent;background: transparent">{{ $siparis->orderno }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $siparis->receiver_name }} {{ $siparis->receiver_surname }}</td>
                                        <td>{{ $siparis->orderdate }}</td>
                                        <td>₺{{ number_format($siparis->totalprice,2,',','.') }}</td>
                                        <td>{{ $siparis->description }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="6">{{ $ay }} Ayına ait satış bulunmamaktadır.</td>
                                </tr>
                            @endif
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
