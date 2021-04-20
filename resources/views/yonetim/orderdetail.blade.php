@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - Sipariş Detayı')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">Sipariş Detayı</h1>
                        <a href="{{ url()->previous() }}" class="float-right"> <i class="far fa-arrow-alt-circle-left"></i> Geri Dön</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>Siparişi Oluşturan : {{ $order->name }} {{ $order->surname }}
                                        <small class="float-right">Sipariş Tarihi: {{ $order->orderdate }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Alıcı Bilgileri
                                    <address>
                                        <strong>{{ $order->receiver_name }} {{ $order->receiver_surname }}</strong><br>
                                        {{ $order->cityname }}/{{ $order->districtname }}<br/>
                                        {{ $order->quarter }}<br/>
                                        {{ $order->address }}<br/>
                                        +90{{ $order->receiver_phone }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Sipariş No #{{ $order->orderno }}</b><br>
                                    <br>
                                    <b>Sipariş Durumu :</b> {{ $order->description }}<br>
                                    <b>Ödeme Yöntemi :</b> {{ $order->methodname }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Ürün</th>
                                            <th></th>
                                            <th></th>
                                            <th>Adet</th>
                                            <th>Tutar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($basket_items as $item)
                                            <tr>
                                                <td colspan="2">{{ $item->name }} {{ $item->weight }}GR</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>₺{{ number_format($item->quantity * $item->itemprice,2,',','.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Ara Toplam:</th>
                                                <td>₺{{ number_format($aratoplam,2,',','.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>KDV</th>
                                                <td>₺{{ number_format($kdv, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Toplam:</th>
                                                <td>₺{{ number_format($uruntutari, 2, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <form action="{{ route('yonetim.order_print') }}" method="post" rel="noopener" target="_blank">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                        <button  class="btn btn-default">
                                            <i class="fas fa-print"></i> Siparişi Yazdır
                                        </button>
                                    </form>
                                    <form>
                                    <button type="button" class="btn btn-success float-right">
                                        <i class="far fa-credit-card"></i> bi buton
                                    </button>
                                    </form>
                                    <form>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> bi buton
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
