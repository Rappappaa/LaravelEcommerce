@extends('layouts.master')
@section('content')
    <!-- site__body -->
    <div class="site__body">
        <div class="page-header">
            <div class="page-header__container container">
                <div class="page-header__breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Ana Sayfa</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Hesabım</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Şifre Değiştirme</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Şifre Değiştirme</h1>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 d-flex">
                        <div class="account-nav flex-grow-1">
                            <h4 class="account-nav__title">Kullanıcı İşlemleri</h4>
                            <ul>
                                <li class="account-nav__item">
                                    <a href="{{ route('user.dashboard') }}">Genel Bakış</a>
                                </li>
                                <li class="account-nav__item">
                                    <a href="{{ route('user.profile') }}">Profilim</a>
                                </li>
                                <li class="account-nav__item">
                                    <a href="{{ route('user.orders') }}">Siparişlerim</a>
                                </li>
                                <li class="account-nav__item">
                                    <a href="{{ route('user.address') }}">Adreslerim</a>
                                </li>
                                <li class="account-nav__item account-nav__item--active">
                                    <a href="{{ route('user.change_password') }}">Şifre Değiştirme</a>
                                </li>
                                <li class="account-nav__item ">
                                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                        <div class="card">
                            <div class="card-header">
                                <h5>Şifre Değiştirme</h5>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-12 col-lg-7 col-xl-6">
                                        <form action="{{ route('user.change_password_action') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="password-current">Mevcut Şifreniz</label>
                                                <input type="password" class="form-control" id="password-current" name="password-current" placeholder="Mevcut Şifreniz" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password-new">Yeni Şifreniz</label>
                                                <input type="password" class="form-control" id="password-new" name="password-new" placeholder="Yeni Şifreniz" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm">Yeni Şifrenizin Tekrarı</label>
                                                <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Yeni Şifrenizin Tekrarı" required>
                                            </div>
                                            <div class="form-group mt-5 mb-0">
                                                <button class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
