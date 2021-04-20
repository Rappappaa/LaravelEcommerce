@extends('layouts.master')
@section('content')
    <!-- site__body -->
    <div class="site__body">
    <div class="block order-success">
        <div class="container">
            <div class="order-success__body">
                <div class="order-success__header">
                    <svg class="order-success__icon" width="100" height="100">
                        <use xlink:href="../images/sprite.svg#check-100"></use>
                    </svg>
                    <h1 class="order-success__title">Siparişiniz için Teşekkürler!</h1>
                    <div class="order-success__subtitle">Siparişiniz tarafımıza ulaştı. Bizde en kısa sürede sizlere ulaştırmak için hemen hazırlıyoruz!</div>
                    <div class="order-success__actions">
                        <a href="{{ route('home') }}" class="btn btn-xs btn-secondary">Ana Sayfaya Git</a>
                    </div>
                </div>
                <div class="order-success__meta">
                    <ul class="order-success__meta-list">
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Sipariş Kodunuz:</span>
                            <span class="order-success__meta-value">#{{ $order->orderno }}</span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Sipariş Tarihi:</span>
                            <span class="order-success__meta-value">{{ $order->orderdate }}</span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Tutar:</span>
                            <span class="order-success__meta-value">₺{{ number_format($uruntutari, 2, ',', '.') }}</span>
                        </li>
                        <li class="order-success__meta-item">
                            <span class="order-success__meta-title">Ödeme Yönteminiz:</span>
                            <span class="order-success__meta-value">{{ $order->methodname }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="order-list">
                        <table>
                            <thead class="order-list__header">
                            <tr>
                                <th class="order-list__column-label" colspan="2">Ürün</th>
                                <th class="order-list__column-quantity">Adet</th>
                                <th class="order-list__column-total">Tutar</th>
                            </tr>
                            </thead>
                            <tbody class="order-list__products">
                            @foreach($items = DB::table('basket_item')
->join('product','basket_item.ref_product' , '=', 'product.id')
->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => $basket->id])->get() as $items)
                                <tr>
                                <td class="order-list__column-image">
                                    <div class="product-image">
                                        <a href="{{ route('product',$items->slug) }}" class="product-image__body">
                                            <img class="product-image__img" src="{{ $items->image }}" alt="{{ $items->name }}">
                                        </a>
                                    </div>
                                </td>
                                <td class="order-list__column-product">
                                    <a href="{{ route('product',$items->slug) }}">{{ $items->name }}</a>
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
                                <td class="order-list__column-quantity">{{ $items->quantity }}</td>
                                <td class="order-list__column-total">₺{{ number_format($items->itemprice * $items->quantity, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tbody class="order-list__subtotals">
                            <tr>
                                <th class="order-list__column-label" colspan="3">Ara Toplam</th>
                                <td class="order-list__column-total">₺{{ number_format($aratoplam, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="order-list__column-label" colspan="3">KDV</th>
                                <td class="order-list__column-total">₺{{ number_format($kdv, 2, ',', '.') }}</td>
                            </tr>
                            </tbody>
                            <tfoot class="order-list__footer">
                            <tr>
                                <th class="order-list__column-label" colspan="3">Toplam</th>
                                <td class="order-list__column-total">
                                        ₺{{ number_format($uruntutari, 2, ',', '.') }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-3 no-gutters mx-n2">
                    <div class="col-sm-12 col-12 px-2">
                        <div class="card address-card">
                            <div class="address-card__body">
                                <div class="address-card__badge address-card__badge--muted">Gönderim Adresi</div>
                                <div class="address-card__row">
                                    <div class="address-card__name">{{ $address->receiver_name }} {{ $address->receiver_surname }}</div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">İl</div>
                                    <div class="address-card__row-content">{{ $address->cityname }}</div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">İlçe</div>
                                    <div class="address-card__row-content">{{ $address->districtname }}</div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Mahalle/Semt</div>
                                    <div class="address-card__row-content">{{ $address->quarter }}</div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Adres</div>
                                    <div class="address-card__row-content">{{ $address->address }}</div>
                                </div>
                                <div class="address-card__row">
                                    <div class="address-card__row-title">Telefon</div>
                                    <div class="address-card__row-content">+90{{ $address->receiver_phone }}</div>
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
