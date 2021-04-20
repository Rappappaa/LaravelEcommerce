@extends('yonetim.layouts.master')
@section('title',config('app.name') . ' - ' . $pagetitle)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $pagetitle }}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-12">
                        <form action="{{ route('yonetim.products_edit') }}" method="POST">
                        {{ csrf_field() }}
                            <input type="hidden" id="recordid" name="recordid"
                                   @if($product == null) value="0" @endif
                                   @if($product != null) value="{{ $product->id }}" @endif
                            >
                            <input type="hidden" id="mode" name="mode" value="update">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @if($product !=null)
                                        {{ $product->name }} {{ $product->weight }}GR
                                    @else
                                        Yeni Ürün Ekleme
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body col-sm-6">
                                @if($product != null) <img src="{{ $product->image }}"> @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ürün Barkodu</label>
                                    <input type="text" class="form-control" id="urunbarkodu" name="urunbarkodu" placeholder="Ürün Barkodu" autofocus
                                    @if($product != null)
                                        value="{{ $product->barcode }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ürün Adı</label>
                                    <input type="text" class="form-control" id="urunadi" name="urunadi" placeholder="Ürün Adı" required
                                       @if($product != null)
                                       value="{{ $product->name }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ürün Açıklaması</label>
                                    <input type="text" class="form-control" id="urunaciklamasi" name="urunaciklamasi" placeholder="Ürün Açıklaması"
                                       @if($product != null)
                                       value="{{ $product->description }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gramaj</label>
                                    <input type="text" class="form-control" id="urungramaji" name="urungramaji" placeholder="Gramaj" required
                                       @if($product != null)
                                       value="{{ $product->weight }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">KDV Oranı</label>
                                    <input type="text" class="form-control" id="kdvorani" name="kdvorani" placeholder="KDV Oranı" required
                                       @if($product != null)
                                       value="{{ $product->tax }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ürün Fiyatı</label>
                                    <input type="text" class="form-control" id="urunfiyati" name="urunfiyati" placeholder="Ürün Fiyatı" required
                                       @if($product != null)
                                       value="{{ $product->price }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ürün Markası</label>
                                    <input type="text" class="form-control" id="urunmarkasi" name="urunmarkasi" placeholder="Ürün Markası" required
                                       @if($product != null)
                                       value="{{ $product->brand }}"
                                    @endif>
                                </div>
                                @if($product == null)
                                <div class="form-group">
                                    <label for="exampleInputFile">Ürün Resmi</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Dosya Seç</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Yükle</span>
                                            </div>
                                        </div>
                                </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
                            </div>
                        </div>
                        <!-- /.card -->
                        </form>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

