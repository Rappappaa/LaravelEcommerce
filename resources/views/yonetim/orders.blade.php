@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - Siparişler')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1 class="m-0 text-dark">{{ $pagetitle }}</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-body p-0">
                @if(Count($orders) > 0)
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 8%;">
                            Sipariş No
                        </th>
                        <th style="width: 13%;">
                            Sipariş Veren
                        </th>
                        <th style="width: 10%;">
                            Tarih
                        </th>
                        <th style="width: 8%;">
                            Durum
                        </th>
                        <th style="width: 8%;">
                            Tutar
                        </th>
                        <th style="width: 45%;" >
                            @if($pagetitle == "Gönderilecekler")
                                <button class="btn btn-primary btn-sm" style="float: right;height: 24px;" onclick="box()">
                                    <i class="fas fa-file-export"></i> Tümünü Dışa Aktar
                                </button>
                            @endif
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                        <td>{{ $order->orderno }}</td>
                        <td>{{ $order->name }} {{ $order->surname }}</td>
                        <td>{{ $order->orderdate }}</td>
                        <td>
                            @if($order->description == "Hazırlanıyor")
                                <span class="badge badge-primary">{{ $order->description }}</span>
                            @elseif($order->description == "Ödeme Bekliyor")
                                <span class="badge badge-secondary">{{ $order->description }}</span>
                            @elseif($order->description == "Kargoya Verilecek")
                                <span class="badge badge-warning">{{ $order->description }}</span>
                            @elseif($order->description == "Kargoya Verildi")
                                <span class="badge badge-info">{{ $order->description }}</span>
                            @elseif($order->description == "Tamamlandı")
                                <span class="badge badge-success">{{ $order->description }}</span>
                            @elseif($order->description == "İptal Edildi")
                                <span class="badge badge-danger">{{ $order->description }}</span>
                            @endif
                        </td>
                        <td><strong>₺{{ number_format($order->totalprice,2,',','.') }}</strong></td>
                        <td class="project-actions text-right" style="display: flex;">
                            <form action="{{ route('yonetim.order_detail') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Görüntüle
                                </button>
                            </form>
                            &nbsp;
                            <form action="{{ route('yonetim.order_print') }}" method="post" rel="noopener" target="_blank">
                                {{ csrf_field() }}
                                <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Siparişi Yazdır
                                </button>
                            </form>
                            &nbsp;
                            <form action="{{ route('yonetim.order_invoice') }}" method="post" rel="noopener" target="_blank">
                                {{ csrf_field() }}
                                <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                <button class="btn btn-dark btn-sm">
                                    <i class="fas fa-eye"></i> Faturayı Yazdır
                                </button>
                            </form>
                            &nbsp;
                            @if($order->description == "Kargoya Verilecek" || $order->description == "Kargoya Verildi" || $order->description == "Tamamlandı")
                                <form action="{{ route('yonetim.previous_step') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-arrow-alt-circle-left"></i> Önceki Adım
                                    </button>
                                </form>
                                &nbsp;
                            @endif
                            @if($order->description == "Hazırlanıyor" || $order->description == "Ödeme Bekliyor" || $order->description == "Kargoya Verilecek" || $order->description == "Kargoya Verildi")
                            <form action="{{ route('yonetim.next_step') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-arrow-alt-circle-right"></i> Sonraki Adım
                                </button>
                            </form>
                            &nbsp;
                            @endif
                            @if($order->description != "İptal Edildi")
                                <form action="{{ route('yonetim.order_cancel') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-arrow-alt-circle-right"></i> İptal Et
                                    </button>
                                </form>
                            @endif
                            @if($order->description == "İptal Edildi")
                                <form action="{{ route('yonetim.order_cancel') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="siparisid" name="siparisid" value="{{ $order->orderno }}">
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-arrow-alt-circle-right"></i> Aktif Yap
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                @else
                    <div style="vertical-align: center;horiz-align: center;margin: 50px;">
                        <span style="font-size: 22px">Görüntülenecek Sipariş Bulunmamaktadır.</span>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<script>
    function  box(){
        var userval = confirm("Kayıtları Dışa Aktarmak İstiyor musunuz?");
        if(userval == true){
            document.location.href = "/yonetim/cikti";
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    }
</script>
<!-- /.content-wrapper -->
@endsection
