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
                            <li class="breadcrumb-item active" aria-current="page">Sepetim</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Sepetim</h1>
                </div>
            </div>
        </div>
        @if( $items = DB::table('basket_item')->where(['ref_user' => auth()->user()->id, 'ref_basket' => null])->Count() > 0)
        <div class="cart block">
            <div class="container">
                <table class="cart__table cart-table">
                    <thead class="cart-table__head">
                    <tr class="cart-table__row">
                        <th class="cart-table__column cart-table__column--image">Resim</th>
                        <th class="cart-table__column cart-table__column--product">Ürün</th>
                        <th class="cart-table__column cart-table__column--price">Fiyat</th>
                        <th class="cart-table__column cart-table__column--quantity">Adet</th>
                        <th class="cart-table__column cart-table__column--total">Tutar</th>
                        <th class="cart-table__column cart-table__column--remove"></th>
                    </tr>
                    </thead>
                    <tbody class="cart-table__body">
                    @foreach($items = DB::table('basket_item')
->join('product','basket_item.ref_product' , '=', 'product.id')
->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get() as $items)
                    <tr class="cart-table__row">
                        <td class="cart-table__column cart-table__column--image">
                            <div class="product-image">
                                <a href="{{ route('product',$items->slug) }}" class="product-image__body">
                                    <img class="product-image__img" src="{{ $items->image }}" alt="{{ $items->description }}">
                                </a>
                            </div>
                        </td>
                        <td class="cart-table__column cart-table__column--product">
                            <a href="{{ route('product',$items->slug) }}" class="cart-table__product-name">{{ $items->name }}</a>
                            <ul class="cart-table__options">
                                <li>{{ $items->weight }} GR</li>
                            </ul>
                        </td>
                        <td class="cart-table__column cart-table__column--price" data-title="Fiyat">₺{{ number_format($items->price, 2, ',', '.') }}</td>
                        <td class="cart-table__column cart-table__column--quantity" data-title="Adet">
                            <div class="input-number">
                                <input class="form-control input-number__input" type="number" min="1" value="{{ $items->quantity }}">
                                <form action="{{ route('cart_adet') }}" METHOD="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="urunid" name="urunid" value="{{ $items->id }}">
                                    <input type="hidden" id="type" name="type" value="artir">
                                    <button class="input-number__add" style="background: transparent; border-color: transparent;"></button>
                                </form>
                                <form action="{{ route('cart_adet') }}" METHOD="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="urunid" name="urunid" value="{{ $items->id }}">
                                    <input type="hidden" id="type" name="type" value="azalt">
                                        <button class="input-number__sub" style="background: transparent; border-color: transparent;"></button>
                                </form>
                            </div>
                        </td>
                        <td class="cart-table__column cart-table__column--total" data-title="Tutar">₺{{ number_format($items->quantity * $items->price, 2, ',', '.') }}</td>
                        <td class="cart-table__column cart-table__column--remove">
                            <form action="{{ route('cart_kaldir') }}" METHOD="post">
                                <input type="hidden" id="urunid" name="urunid" value="{{ $items->id }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-light btn-sm btn-svg-icon">
                                    <svg width="12px" height="12px">
                                        <use xlink:href="../images/sprite.svg#cross-12"></use>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="cart__actions">
                    <form action="{{ route('cart_bosalt') }}" METHOD="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-danger dropcart__empty-button">Sepeti Boşalt</button>
                    </form>
                    <div class="cart__buttons">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Alışverişe Devam Et</a>
                    </div>
                </div>
                <div class="row justify-content-end pt-5">
                    <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Sepet Bilgileri</h3>
                                <table class="cart__totals">
                                    <thead class="cart__totals-header">
                                    <tr>
                                        <th>Ara Toplam</th>
                                        <td>₺{{ number_format($aratoplam, 2, ',', '.') }}</td>
                                    </tr>
                                    </thead>
                                    <tbody class="cart__totals-body">
                                    <tr>
                                        <th>KDV</th>
                                        <td>₺{{ number_format($kdv, 2, ',', '.') }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot class="cart__totals-footer">
                                    <tr>
                                        <th>Toplam</th>
                                        <td>
                                            ₺{{ number_format($uruntutari, 2, ',', '.') }}
                                    </tr>
                                    </tfoot>
                                </table>
                                <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{ route('completeorder') }}">Ödemeye Geç</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="block-empty__body">
            <div class="block-empty__message">Sepetinizde ürün bulunmuyor!</div>
            <div class="block-empty__actions">
                <a class="btn btn-primary btn-sm" href="{{ route('shop') }}">Mağaza</a>
            </div>
        </div>
            @endif
    </div>
    <!-- site__body / end -->
@endsection
