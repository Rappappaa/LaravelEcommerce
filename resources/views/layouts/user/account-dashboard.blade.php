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
                            <li class="breadcrumb-item active" aria-current="page">Genel Bakış</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Genel Bakış</h1>
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
                                <li class="account-nav__item account-nav__item--active">
                                    <a href="{{ route('user.dashboard') }}">Genel Bakış</a>
                                </li>
                                <li class="account-nav__item ">
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
                        <div class="dashboard">
                            <div class="dashboard__profile card profile-card">
                                <div class="card-body profile-card__body">
                                    <svg width="48px" height="48px">
                                        <use xlink:href="../images/sprite.svg#person-20"></use>
                                    </svg>
                                    <br/>
                                    <div class="profile-card__name">{{ auth()->user()->name }} {{ auth()->user()->surname }}</div>
                                    <div class="profile-card__email">{{ auth()->user()->email }}</div>
                                    <div class="profile-card__edit">
                                        <a href="{{ route('user.profile') }}" class="btn btn-secondary btn-sm">Düzenle</a>
                                    </div>
                                </div>
                            </div>
                            @if($adres == null)
                                <div class="dashboard__address card address-card address-card--featured" style="vertical-align: center;horiz-align: center;text-align: center">
                                    <form action="{{ route('user.add_address') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="mode" name="mode" value="new">
                                        <br/><br/><br/><br/><br/>
                                        <span>Henüz kayıtlı bir adresiniz bulunmamaktadır.</span><br/><br/>
                                        <button class="btn btn-secondary btn-sm">Adres Ekle</button>
                                    </form>
                                </div>
                            @else
                            <div class="dashboard__address card address-card address-card--featured">
                                <div class="address-card__badge">Varsayılan Adres</div>
                                <div class="address-card__body">
                                    <div class="address-card__name">{{ $adres->receiver_name }} {{ $adres->receiver_surname }}</div>
                                    <div class="address-card__row-title">Adres</div>
                                    <div class="address-card__row">
                                        {{ $adres->address }}
                                    </div>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title">İl/İlçe</div>
                                        <div class="address-card__row-content">{{ $adres->cityname }} / {{ $adres->districtname }}</div>
                                    </div>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title">Mahalle/Semt</div>
                                        <div class="address-card__row-content">{{ $adres->quarter }}</div>
                                    </div>
                                    <div class="address-card__row">
                                        <div class="address-card__row-title">Telefon</div>
                                        <div class="address-card__row-content">+90{{ $adres->receiver_phone }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(Count($orders)<1)
                                <div class="dashboard__orders">
                                    <div class="card">
                                        <div class="card-header">
                                        Görüntülenecek siparişiniz bulunmamaktadır.
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="dashboard__orders">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Siparişlerim</h5>
                                            </div>
                                            <div class="card-divider"></div>
                                            <div class="card-table">
                                                <div class="table-responsive-sm">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>Sipariş No</th>
                                                            <th>Tarih</th>
                                                            <th>Durum</th>
                                                            <th>Tutar</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>
                                                                    <form action="{{ route('user.order_detail') }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" id="orderid" name="orderid" value="{{ $order->orderno }}">
                                                                        <button style="background: transparent; border-color: transparent;">#{{ $order->orderno }}</button>
                                                                    </form>
                                                                </td>
                                                                <td>{{ $order->orderdate }}</td>
                                                                <td>{{ $order->description }}</td>
                                                                <td>₺{{ number_format($order->totalprice,2,',','.') }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
