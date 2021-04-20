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
                            <li class="breadcrumb-item active" aria-current="page">Siparişlerim</li>
                            <li class="breadcrumb-item active" aria-current="page">Sipariş Detayı</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Sipariş Detayı</h1>
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
                                <li class="account-nav__item account-nav__item--active">
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
                            <div class="order-header">
                                <div class="order-header__actions">
                                    <a href="{{ route('user.orders') }}" class="btn btn-xs btn-secondary">Siparişlerime Dön</a>
                                </div>
                                <h5 class="order-header__title">Sipariş No: #{{ $orders->orderno }}</h5>
                                <div class="order-header__subtitle">
                                    Siparişiniz <mark class="order-header__date">{{ $orders->orderdate }}</mark> tarihinde oluşturulmuştur.<br/><br/>
                                    Ödeme Yöntemi <mark class="order-header__status">{{ $orders->methodname }}</mark>.<br/><br/>
                                    Sipariş Durumu <mark class="order-header__status">{{ $orders->description }}</mark>.
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-table">
                                <div class="table-responsive-sm">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="4">Ürün</th>
                                                <th></th>
                                                <th></th>
                                                <th>Tutar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="card-table__body card-table__body--merge-rows">
                                        @foreach($items = DB::table('basket_item')
                                                        ->join('product','basket_item.ref_product' , '=', 'product.id')
                                                        ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => $basket->id])->get() as $items)
                                            <tr>
                                                <td colspan="4">
                                                    {{ $items->name }}
                                                    <div class="order-list__options">
                                                        <ul class="order-list__options-list">
                                                            <li class="order-list__options-item">
                                                                <span class="order-list__options-value">{{ $items->quantity }}</span>
                                                                <span class="order-list__options-label"> Adet</span>
                                                                <span class="order-list__options-label"> {{ $items->weight }}GR</span>
                                                                <span class="order-list__options-label"> / Birim Fiyatı : </span>
                                                                <span class="order-list__options-value">₺{{ number_format($items->itemprice,2,',','.') }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>₺{{ number_format($items->itemprice * $items->quantity,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tbody class="card-table__body card-table__body--merge-rows">
                                        <tr>
                                            <th colspan="4">Ara Toplam</th>
                                            <td></td>
                                            <td></td>
                                            <td>₺{{ number_format(($items->itemprice * $items->quantity) - ($items->itemprice * $items->quantity) * 8 / 100,2,',','.') }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="4">KDV</th>
                                            <td></td>
                                            <td></td>
                                            <td>₺{{ number_format(($items->itemprice * $items->quantity) * 8 /100, 2, ',', '.') }}</td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="4">Toplam</th>
                                            <td></td>
                                            <td></td>
                                            <td>₺{{ number_format($orders->totalprice,2,',','.') }}</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 no-gutters mx-n2">
                            <div class="col-sm-12 col-12 px-2">
                                <div class="card address-card address-card--featured">
                                    <div class="address-card__body">
                                        <div class="address-card__badge address-card__badge--muted">Gönderim Adresi</div>
                                        <div class="address-card__name">{{ $adres->receiver_name }} {{ $adres->receiver_surname }}</div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Adres</div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
