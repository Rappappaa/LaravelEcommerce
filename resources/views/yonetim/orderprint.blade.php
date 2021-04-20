<!DOCTYPE html>
<html lang="TR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - Sipariş Yazdırma</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
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
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>
