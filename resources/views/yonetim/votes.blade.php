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
                            <span class="info-box-icon bg-info"><i class="fas fa-comment" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    @if($pagetitle == "Tüm Yorumlar")
                                        Toplam Yorum
                                    @endif
                                    @if($pagetitle == "Aktif Yorumlar")
                                        Toplam Aktif Yorum
                                    @endif
                                    @if($pagetitle == "Pasif Yorumlar")
                                        Toplam Pasif Yorum
                                    @endif
                                    <span class="text-muted">({{ $commentcount }} Adet)</span></span>
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
                                Kullanıcı
                            </th>
                            <th style="width: 26%;">
                                Ürün
                            </th>
                            <th style="width: 5%;">
                                Puan
                            </th>
                            <th style="width: 27%;">
                                Yorum
                            </th>
                            <th style="width: 10%;">
                                Durum
                            </th>
                            <th style="width: 10%;">
                                Tarih
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($commentcount>0)
                            @foreach($votes as $vote)
                                <tr>
                                    <td>{{ $vote->id }}</td>
                                    <td>
                                        <?php
                                        $item = DB::table('user')->Where('id','=',$vote->ref_user)->First();
                                        echo $item->name . " " . $item->surname;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $item = DB::table('product')->Where('id','=',$vote->ref_product)->First();
                                        echo $item->name . " - " . $item->weight . "GR";
                                        ?>
                                    </td>
                                    <td>{{ $vote->value }}</td>
                                    <td>{{ $vote->comment }}</td>
                                    <td>
                                        @if($vote->active == true)
                                            {{ "Aktif" }}
                                        @else
                                            {{ "Pasif" }}
                                        @endif
                                    </td>
                                    <td>{{ $vote->date }}</td>
                                    <td style="display: flex;">
                                        @if($vote->active == true)
                                            <form action="{{ route('yonetim.passive_votes_action') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="commentid" name="commentid" value="{{ $vote->id }}">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-chain"></i> Pasif Yap
                                                </button>
                                            </form>
                                        @endif
                                        @if($vote->active == false)
                                            <form action="{{ route('yonetim.active_votes_action') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="commentid" name="commentid" value="{{ $vote->id }}">
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-chain"></i> Aktif Yap
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">Yorum bulunmamaktadır.</td>
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

