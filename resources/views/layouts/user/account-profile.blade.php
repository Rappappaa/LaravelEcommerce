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
                            <li class="breadcrumb-item active" aria-current="page">Profilim</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Profilim</h1>
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
                                <li class="account-nav__item account-nav__item--active">
                                    <a href="{{ route('user.profile') }}">Profilim</a>
                                </li>
                                <li class="account-nav__item ">
                                    <a href="{{ route('user.orders') }}">Siparişlerim</a>
                                </li>
                                <li class="account-nav__item">
                                    <a href="{{ route('user.address') }}">Adreslerim</a>
                                </li>
                                <li class="account-nav__item ">
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
                                <h5>Profilim</h5>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-12 col-lg-7 col-xl-6">
                                        <form action="{{ route('user.edit_profile') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Adınız</label>
                                                <input type="text" class="form-control" placeholder="Adınız" id="name" name="name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Soyadınız</label>
                                                <input type="text" class="form-control" placeholder="Soyadınız" id="surname" name="surname"  value="{{ $user->surname }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Telefon Numaranız <span class="text-muted">(10 Haneli olacak şekilde)</span></label>
                                                <input type="text" pattern="^[0-9]+$" class="form-control" placeholder="+90 xxx xx xx" id="phone" name="phone"  value="{{ $user->phone }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email adresiniz</label>
                                                <input type="email" class="form-control" placeholder="Email adresiniz" id="email" name="email"  value="{{ $user->email }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
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
