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
                                <a href="{{ route('cart') }}">Sepetim</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Siparişi Tamamla</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Siparişi Tamamla</h1>
                </div>
            </div>
        </div>
        <div class="checkout block">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="card mb-lg-0">
                            <div class="card-body">
                                <h3 class="card-title">Adres Bilgileri</h3>
                                @if($address != null)
                                    <div class="addresses-list">
                                            @foreach($addresses as $addresses)
                                            <div class="addresses-list__item card address-card">
                                                @if($addresses->default == 1)
                                                <div class="address-card__badge">Varsayılan</div>
                                                @endif
                                                <div class="address-card__body">
                                                    <div class="address-card__name">{{ $addresses->receiver_name}} {{ $addresses->receiver_surname}}</div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">İl/İlçe</div>
                                                        <div class="address-card__row-content">{{ $addresses->cityname}}/{{ $addresses->districtname}}</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Mahalle/Semt</div>
                                                        <div class="address-card__row-content">{{ $addresses->quarter}}</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Adres</div>
                                                        <div class="address-card__row">{{ $addresses->address}}</div>
                                                    </div>
                                                    <div class="address-card__row">
                                                        <div class="address-card__row-title">Telefon</div>
                                                        <div class="address-card__row-content">+90{{ $addresses->receiver_phone}}</div>
                                                    </div>
                                                </div>
                                                <div class="address-card__footer" style="vertical-align: bottom;margin: 5px;padding: 5px">
                                                    <form action="{{ route('completeorder') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="adresid" name="adresid" value="{{ $addresses->id }}">
                                                        <button  type="submit" class="btn btn-primary btn-s btn-block">Kullan</button>
                                                    </form>
                                                </div>
                                                <div class="address-card__footer" style="vertical-align: bottom;margin: 5px;padding: 5px">
                                                    <form action="{{ route('user.edit_address') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="mode" name="mode" value="view">
                                                        <input type="hidden" id="adresid" name="adresid" value="{{ $addresses->id }}">
                                                        <input type="hidden" id="gidecegiyer" name="gidecegiyer" value="{{ Request::route()->getName() }}">
                                                        <button class="btn btn-secondary btn-s btn-block">Düzenle</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="addresses-list__divider"></div>
                                            @endforeach
                                        </div>
                                <br/>
                    <form action="{{ route('makepayment') }}" method="POST">
                        <input type="hidden" id="adresid" name="adresid" value="{{ $address->id }}">
                        {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="checkout-first-name">Alıcı Adı</label>
                                        <input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="Alıcı Adı" value="{{ $address->receiver_name }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="checkout-last-name">Alıcı Soyadı</label>
                                        <input type="text" class="form-control" id="receiver_surname" name="receiver_surname" value="{{ $address->receiver_surname }}" placeholder="Alıcı Soyadı" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-phone">Alıcı Telefon Numarası <span class="text-muted">(10 Haneli olacak şekilde)</span></label>
                                    <input type="text" pattern="^[0-9]+$" class="form-control" id="receiver_phone" name="receiver_phone" placeholder="Telefon" value="{{ $address->receiver_phone }}" disabled>
                                </div>
                                <div class="form-row">
                                    <div class="block-finder__form-item col-md-6">
                                        <label for="checkout-country">İl</label>
                                        <select name="city_menu" id="city_menu" class="form-control" onchange="populate(this.id, 'district_menu')" disabled>
                                                <option value="{{ $addresses->cityid }}" selected>{{ $addresses->cityname }}</option>
                                        </select>
                                    </div>
                                    <div class="block-finder__form-item col-md-6">
                                        <label for="checkout-country">İlçe</label>
                                        <select name="district_menu" id="district_menu"  class="form-control"  disabled>
                                                <option value="{{ $addresses->districtid }}">{{ $addresses->districtname }}</option>
                                        </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <label for="checkout-street-address">Mahalle/Semt</label>
                                    <input type="textarea" class="form-control" id="quarter" name="quarter" placeholder="Mahalle/Semt" value="{{ $address->quarter }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="checkout-street-address">Adres</label>
                                    <textarea id="address" name="address" class="form-control" rows="4" placeholder="Adres" disabled>{{ $address->address }}</textarea>
                                </div>
                                    @else
                                <div class="form-row">
                                    <form action="{{route('user.add_address')}}" METHOD="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="mode" name="mode" value="new">
                                        <input type="hidden" id="gidecegiyer" name="gidecegiyer" value="{{ Request::route()->getName() }}">
                                        <p>Sistemde kayıtlı adres bulunamadı.
                                            <br/>
                                        Lütfen<button type="submit" style="border: none; background: none;color: blue;">buraya</button>tıklayarak bir adres ekleyiniz.
                                        <br/>Dilerseniz birden fazla adres kaydederek sonraki siparişlerinizde kullanabilirsiniz.</p>
                                    </form>
                                </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Sipariş Özetiniz</h3>
                                <table class="checkout__totals">
                                    <thead class="checkout__totals-header">
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Adet</th>
                                        <th>Tutar</th>
                                    </tr>
                                    </thead>
                                    <tbody class="checkout__totals-products">
                                    @foreach($items = DB::table('basket_item')
->join('product','basket_item.ref_product' , '=', 'product.id')
->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get() as $items)
                                    <tr>
                                        <td style="vertical-align: top">{{ $items->name }} <br/>
                                            <span class="text-muted" style="font-size: 12px">Gramaj : {{ $items->weight }} GR</span><br/>
                                            <span class="text-muted" style="font-size: 12px">Birim Fiyatı : ₺{{ number_format($items->price, 2, ',', '.') }} </span>
                                        </td>
                                        <td style="vertical-align: top">{{ $items->quantity }}</td>
                                        <td style="vertical-align: top">₺{{ number_format($items->itemprice * $items->quantity, 2, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody class="checkout__totals-subtotals">
                                    <tr>
                                        <th>Ara Toplam</th>
                                        <td></td>
                                        <td>₺{{ number_format($aratoplam, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>KDV</th>
                                        <td></td>
                                        <td>₺{{ number_format($kdv, 2, ',', '.') }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot class="checkout__totals-footer">
                                    <tr>
                                        <th>Toplam</th>
                                        <td></td>
                                        <td>₺{{ number_format($uruntutari, 2, ',', '.') }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="payment-methods">
                                    <ul class="payment-methods__list">
                                        <!--
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header">
                                                    <span class="payment-methods__item-radio input-radio">
                                                        <span class="input-radio__body">
                                                            <input class="input-radio__input" id="checkout_payment_method" name="checkout_payment_method" value="online" type="radio" checked>
                                                            <span class="input-radio__circle"></span>
                                                        </span>
                                                    </span>
                                                <span class="payment-methods__item-title">Online Kredi Kartı</span>
                                            </label>
                                        </li>
                                        -->
                                        <li class="payment-methods__item payment-methods__item">
                                            <label class="payment-methods__item-header">
                                                    <span class="payment-methods__item-radio input-radio">
                                                        <span class="input-radio__body">
                                                            <input class="input-radio__input" id="checkout_payment_method" name="checkout_payment_method" value="bank" type="radio">
                                                            <span class="input-radio__circle"></span>
                                                        </span>
                                                    </span>
                                                <span class="payment-methods__item-title">Banka Transferi (EFT/Havale)</span>
                                            </label>
                                        </li>
                                        <li class="payment-methods__item">
                                            <label class="payment-methods__item-header">
                                                    <span class="payment-methods__item-radio input-radio">
                                                        <span class="input-radio__body">
                                                            <input class="input-radio__input" id="checkout_payment_method" name="checkout_payment_method" value="cod" type="radio" checked>
                                                            <span class="input-radio__circle"></span>
                                                        </span>
                                                    </span>
                                                <span class="payment-methods__item-title">Kapıda Nakit</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="checkout__agree form-group">
                                    <div class="form-check">
                                            <span class="form-check-input input-check">
                                                <span class="input-check__body">
                                                    <input class="input-check__input" type="checkbox" id="checkout-terms" checked="true" required>
                                                    <span class="input-check__box"></span>
                                                    <svg class="input-check__icon" width="9px" height="7px">
                                                        <use xlink:href="../images/sprite.svg#check-9x7"></use>
                                                    </svg>
                                                </span>
                                            </span>
                                        <label class="form-check-label" for="checkout-terms">
                                            <a target="_blank" href="{{ route('obf') }}">Ön Bilgilendirme formunu</a> ve <a target="_blank" href="{{ route('mss') }}">Mesafeli Satış Sözleşmesini</a> okudum,onaylıyorum.
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-xl btn-block">Siparişi Tamamla</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- site__body / end -->
@endsection
