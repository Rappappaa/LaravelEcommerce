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
                        <div class="col-12">
                            <h1 class="m-0 text-dark">{{ $pagetitle }}</h1>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    @if($pagetitle == "Tüm Ürünler")
                                        Toplam Ürün
                                    @endif
                                    @if($pagetitle == "Aktif Ürünler")
                                        Toplam Aktif Ürün
                                    @endif
                                    @if($pagetitle == "Pasif Ürünler")
                                        Toplam Pasif Ürün
                                    @endif
                                    <span class="text-muted">({{ $productsadet }} Adet)</span></span>
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
                            <th style="width: 5%;">
                                ID
                            </th>
                            <th style="width: 10%;">
                                Barkod
                            </th>
                            <th style="width: 10%;">
                                Görsel
                            </th>
                            <th style="width: 20%;">
                                Ad
                            </th>
                            <th style="width: 7%;">
                                Gramaj
                            </th>
                            <th style="width: 7%;">
                                Fiyat
                            </th>
                            <th style="width: 7%;">
                                KDV
                            </th>
                            <th style="width: 7%;">
                                Durum
                            </th>
                            <th style="width: 25%;">
                                <form action="{{ route('yonetim.products_edit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="mode" name="mode" value="view">
                                    <button type="submit" class="btn btn-success btn-sm float-right"> <i class="far fa-plus"></i> Ürün Ekle</button>
                                </form>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Count($products)>0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->barcode == null)
                                            Barkod Yok
                                            @else
                                            {{ $product->barcode }}
                                            @endif
                                    </td>
                                    <td>
                                        @if($product->image == null)
                                            Görsel Eklenmemiş
                                            @else
                                        <img src="{{ $product->image }}" width="40px">
                                            @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->weight }}GR</td>
                                    <td>₺{{ number_format($product->price,2,',','.') }}</td>
                                    <td>%{{ $product->tax }}</td>
                                    <td>
                                        @if($product->active == true)
                                            {{ "Aktif" }}
                                        @else
                                            {{ "Pasif" }}
                                        @endif
                                    </td>
                                    <td style="display: flex;">
                                        @if($product->active == true)
                                            <form action="{{ route('yonetim.products_active_action') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="productid" name="productid" value="{{ $product->id }}">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-chain"></i> Pasif Yap
                                                </button>
                                            </form>
                                        @endif
                                        @if($product->active == false)
                                            <form action="{{ route('yonetim.products_passive_action') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="productid" name="productid" value="{{ $product->id }}">
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-chain"></i> Aktif Yap
                                                </button>
                                            </form>
                                        @endif
                                        &nbsp;
                                        <form action="{{ route('yonetim.products_edit') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="productid" name="productid" value="{{ $product->id }}">
                                            <input type="hidden" id="mode" name="mode" value="view">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Düzenle
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">Ürün bulunmamaktadır.</td>
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

