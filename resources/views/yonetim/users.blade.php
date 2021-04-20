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
                                    @if($pagetitle == "Tüm Kullanıcılar")
                                    Toplam Kullanıcı
                                    @endif
                                    @if($pagetitle == "Aktif Kullanıcılar")
                                        Toplam Aktif Kullanıcı
                                    @endif
                                    @if($pagetitle == "Pasif Kullanıcılar")
                                        Toplam Pasif Kullanıcı
                                    @endif
                                    <span class="text-muted">({{ $usersadet }} Adet)</span></span>
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
                            <th style="width: 10%;">
                                ID</th>
                            <th style="width: 30%;">
                                Ad Soyad
                            </th>
                            <th style="width: 20%;">
                                Eposta
                            </th>
                            <th style="width: 20%;">
                                Telefon
                            </th>
                            <th style="width: 10%;">
                                Durum
                            </th>
                            <th style="width: 10%;">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Count($users)>0)
                            @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }} {{ $user->surname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>+90{{ $user->phone }}</td>
                                        <td>
                                            @if($user->active == true)
                                                {{ "Aktif" }}
                                            @else
                                                {{ "Pasif" }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->active == true)
                                                <form action="{{ route('yonetim.users_active_action') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="userid" name="userid" value="{{ $user->id }}">
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-chain"></i> Pasif Yap
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('yonetim.users_passive_action') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" id="userid" name="userid" value="{{ $user->id }}">
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
                                <td colspan="6">Kullanıcı bulunmamaktadır.</td>
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

