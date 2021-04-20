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
                            <li class="breadcrumb-item active" aria-current="page">Adreslerim</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Adreslerim</h1>
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
                                <li class="account-nav__item ">
                                    <a href="{{ route('user.profile') }}">Profilim</a>
                                </li>
                                <li class="account-nav__item ">
                                    <a href="{{ route('user.orders') }}">Siparişlerim</a>
                                </li>
                                <li class="account-nav__item account-nav__item--active">
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
                        <div class="container">
                            <div class="row">
                                <form action="{{ route('user.add_address') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="mode" name="mode" value="new">
                                    <button class="btn btn-success btn-sm">Yeni Ekle</button>
                                </form>
                                &nbsp;
                                &nbsp;
                                <form action="{{ route('user.address_edit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="mode" name="mode" value="aktifler">
                                    <button class="btn btn-primary btn-sm">Aktif Adresler</button>
                                </form>
                                &nbsp;
                                &nbsp;
                                <form action="{{ route('user.address_edit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="mode" name="mode" value="pasifler">
                                    <button class="btn btn-outline-danger btn-sm">Pasif Adresler</button>
                                </form>
                            </div>
                        </div>
                        <br/>
                        <div class="addresses-list">
                            @if(Count($adres)<1)
                                @if($statu == "aktifler")
                                    <span>Sisteme kayıtlı aktif adresiniz bulunmamaktadır.</span>
                                @endif
                                @if($statu == "pasifler")
                                    <span>Pasif olan adresiniz bulunmamaktadır.</span>
                                @endif
                            @endif
                            @foreach($adres as $adres)
                                <div class="addresses-list__divider"></div>
                                <div class="addresses-list__item card address-card">
                                    @if($adres->default == 1)
                                        <div class="address-card__badge">Varsayılan</div>
                                    @endif
                                        <div class="address-card__body">
                                            <div class="address-card__name">{{ $adres->receiver_name }} {{ $adres->receiver_surname }}</div>
                                            <div class="address-card__row-title">Adres</div>
                                            <div class="address-card__row">
                                                {{ $adres->address }}
                                            </div>
                                            <div class="address-card__row">
                                                <div class="address-card__row-title">İl/İlçe</div>
                                                <div class="address-card__row-content">{{ $adres->cityname }} / {{ $adres->districtname }} </div>
                                            </div>
                                            <div class="address-card__row">
                                                <div class="address-card__row-title">Mahalle/Semt</div>
                                                <div class="address-card__row-content">{{ $adres->quarter }}</div>
                                            </div>
                                            <div class="address-card__row">
                                                <div class="address-card__row-title">Telefon</div>
                                                <div class="address-card__row-content">+90{{ $adres->receiver_phone }}</div>
                                            </div>
                                            <br/>
                                            <div class="address-card__footer" style="display: flex;">
                                            <div style="display: flex;">
                                                @if($statu == "aktifler")
                                                    <form action="{{ route('user.edit_address') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="mode" name="mode" value="view">
                                                        <input type="hidden" id="adresid" name="adresid" value="{{ $adres->id }}">
                                                        <input type="hidden" id="geldigiyer" name="geldigiyer" value="0">
                                                        <button class="btn btn-secondary btn-sm">Düzenle</button>
                                                    </form>
                                                    &nbsp;
                                                    &nbsp;
                                                    <form action="{{ route('user.delete_address') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="adresid" name="adresid" value="{{ $adres->id }}">
                                                        <button class="btn btn-secondary btn-sm">Kaldır</button>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('user.active_address') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="adresid" name="adresid" value="{{ $adres->id }}">
                                                        <button class="btn btn-secondary btn-sm">Aktif Yap</button>
                                                    </form>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                </div>
                                    <div class="addresses-list__divider"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
