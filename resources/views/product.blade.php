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
                                <a href="{{ route('shop') }}">Glutensiz Mağaza</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop.maincategory',$main_category->slug) }}">{{ $main_category->name }}</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop.maincategory',$category->slug) }}">{{ $category->name }}</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="product product--layout--columnar" data-layout="columnar">
                    <div class="product__content">
                        <!-- .product__gallery -->
                        <div class="product__gallery">
                            <div class="product-gallery">
                                <div class="product-gallery">
                                    <div class="product-gallery__featured">
                                        <button class="product-gallery__zoom">
                                            <svg width="24px" height="24px">
                                                <use xlink:href="../images/sprite.svg#zoom-in-24"></use>
                                            </svg>
                                        </button>
                                        <div class="owl-carousel" id="product-image">
                                            <div class="product-image product-image--location--gallery">
                                                <a href="{{ $product->image }}" class="product-image__body" target="_blank">
                                                    <img class="product-image__img" src="{{ $product->image }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            @foreach($images as $image)
                                            <div class="product-image product-image--location--gallery">
                                                <a href="{{ $image->image}}" class="product-image__body" target="_blank">
                                                    <img class="product-image__img" src="{{ $image->image }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            @endforeach
                                            @foreach($certificates as $certificate)
                                                <div class="product-image product-image--location--gallery">
                                                    <a href="{{ $certificate->image }}" class="product-image__body" target="_blank">
                                                        <img class="product-image__img" src="{{ $certificate->image }}" alt="{{ $certificate->description }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="product-gallery__carousel">
                                        <div class="owl-carousel" id="product-carousel">
                                            <a href="{{ $product->image }}" class="product-image product-gallery__carousel-item">
                                                <div class="product-image__body">
                                                    <img class="product-image__img product-gallery__carousel-image" src="{{ $product->image }}" alt="{{ $product->name }}">
                                                </div>
                                            </a>
                                            @foreach($images as $image)
                                                <a href="{{ $image->image }}" class="product-image product-gallery__carousel-item">
                                                    <div class="product-image__body">
                                                        <img class="product-image__img product-gallery__carousel-image" src="{{ $image->image }}" alt="{{ $product->name }}">
                                                    </div>
                                                </a>
                                            @endforeach
                                            @foreach($certificates as $certificate)
                                                <div class="product-image product-image--location--gallery">
                                                    <a href="{{ $certificate->image }}" class="product-image__body" target="_blank">
                                                        <img class="product-image__img" src="{{ $certificate->image }}" alt="{{ $certificate->description }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .product__gallery / end -->
                        <!-- .product__info -->
                        <div class="product__info">
                            <h1 class="product__name">{{ $product->name }} - {{ $product->weight }} GR</h1>
                            <div class="product-card__rating">
                                <div class="product-card__rating-stars">
                                    <div class="rating">
                                        <div class="rating__body">
                                            <?php
                                            $i = DB::table('product_vote')
                                                ->where('product_vote.active','=',true)
                                                ->where('product_vote.ref_product','=',$product->id)
                                                ->avg('value');
                                            $numberofvotes = DB::table('product_vote')
                                                ->where('product_vote.active','=',true)
                                                ->where('product_vote.ref_product','=',$product->id)
                                                ->Count();
                                            for($j = 1; $j<=5; $j++){
                                            if($j<=$i){
                                            ?>
                                            <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge rating__star--active">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <?php
                                            }else{
                                            ?>
                                            <svg class="rating__star" width="13px" height="12px">
                                                <g class="rating__fill">
                                                    <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                </g>
                                                <g class="rating__stroke">
                                                    <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                </g>
                                            </svg>
                                            <div class="rating__star rating__star--only-edge">
                                                <div class="rating__fill">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                                <div class="rating__stroke">
                                                    <div class="fake-svg-icon"></div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card__rating-legend">
                                    <?php
                                    if($i == 0){
                                        echo "Değerlendirme Yok";
                                    }else{
                                        echo $numberofvotes . " Değerlendirme";
                                    }
                                    ?>
                                </div>
                            </div>
                            &nbsp;
                            <div class="product__description">
                                @if($product->description != null)
                                    {{ $product->description }}
                                    @else
                                    Henüz ürün açıklaması eklenmemiştir.
                                    @endif
                            </div>
                            &nbsp;
                            <ul class="product__meta">
                                @if($product->brand != null)
                                    <li>Marka: {{ $product->brand }}</li>
                                @else
                                    <li>Marka: Belirtilmemiş</li>
                                    @endif
                                @if($product->barcode != null)
                                        <li>Barkod: {{ $product->barcode }}</li>
                                    @else
                                        <li>Barkod: Belirtilmemiş</li>
                                    @endif
                            </ul>
                        </div>
                        <!-- .product__info / end -->
                        <!-- .product__sidebar -->
                        <div class="product__sidebar">
                            <div class="product__availability">
                                    @if($product->stock == 1)
                                        Stok Durumu: <span class="text-success">Stokta Var</span>
                                    @endif
                                    @if($product->stock == 0)
                                        Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                    @endif
                            </div>
                            <div class="product__prices">
                                ₺{{ number_format($product->price,2,',','.') }}
                            </div>
                            <!-- .product__options -->
                                <div class="form-group product__option">
                                    <label class="product__option-label">Gramajlar</label>
                                    <div class="input-radio-label">
                                        <div class="input-radio-label__list">
                                            @foreach($same_products as $same_product)
                                            <label>
                                                <a href="{{ route('product', $same_product->slug) }}">
                                                <input type="radio" name="weight" @if($product->weight == $same_product->weight)checked="true" @endif>
                                                <span>{{ $same_product->weight }} GR</span>
                                                </a>
                                            </label>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            <form action="{{ route('cart_ekle') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                                <div class="form-group product__option">
                                    <label class="product__option-label" for="product-quantity">Adet</label>
                                    <div class="product__actions">
                                        <div class="product__actions-item">
                                            <div class="input-number product__quantity">
                                                <input class="input-number__input form-control form-control-lg" type="number" id="quantity" name="quantity" min="1" value="1">
                                                <div class="input-number__add"></div>
                                                <div class="input-number__sub"></div>
                                            </div>
                                        </div>
                                        <div class="product__actions-item product__actions-item--addtocart">
                                            <button class="btn btn-primary btn-lg"  <?php if($product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- .product__options / end -->
                        </div>
                        <!-- .product__end -->
                    </div>
                </div>
                <div class="product-tabs  product-tabs--sticky">
                    <div class="product-tabs__list">
                        <div class="product-tabs__list-body">
                            <div class="product-tabs__list-container container">
                                <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Ürün Açıklaması</a>
                                <a href="#tab-specification" class="product-tabs__item">Ürün İçeriği</a>
                                <a href="#tab-reviews" class="product-tabs__item">Ürün Yorumları</a>
                            </div>
                        </div>
                    </div>
                    <div class="product-tabs__content">
                        <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                            <div class="typography">
                                @if($product->description == null)
                                    Bu alana ait bir bilgi henüz eklenmemiştir.
                                    @else
                                    {{ $product->description }}
                                @endif
                            </div>
                        </div>
                        <div class="product-tabs__pane" id="tab-specification">
                            <div class="spec">
                                <div class="spec__section">
                                    <h4 class="spec__section-title">İçindekiler</h4>
                                    @if(Count($product_properties)<1)
                                        Bu alana ait bir bilgi henüz eklenmemiştir.
                                    @else
                                        @foreach($product_properties as $product_property)
                                            <div class="spec__row">
                                                <div class="spec__name">{{ $product_property->key }}</div>
                                                <div class="spec__value">{{ $product_property->value }}</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!--
                                <div class="spec__section">
                                    <h4 class="spec__section-title">Besin Değerleri</h4>
                                    <div class="spec__row">
                                        <div class="spec__name">Protein</div>
                                        <div class="spec__value">99</div>
                                    </div>
                                </div>
                                -->
                                <div class="spec__disclaimer">
                                    İçindekiler, Besin Değerleri ve Ürünlerin görünümü ile ilgili bilgiler sadece referans amaçlıdır. Yayınlandığı sırada mevcut olan en güncel bilgilere dayanmaktadır.
                                </div>
                            </div>
                        </div>
                        <div class="product-tabs__pane" id="tab-reviews">
                            <div class="reviews-view">
                                <div class="reviews-view__list">
                                    <h3 class="reviews-view__header">Ürün Yorumları</h3>
                                    <div class="reviews-list">
                                        <ol class="reviews-list__content">
                                            @if(Count($votes) == 0)
                                                Bu ürüne ait yorum bulunmamaktadır. Formu doldurarak hemen bir yorum yapın!
                                            @else
                                            @foreach($votes as $vote)
                                            <li class="reviews-list__item">
                                                <div class="review">
                                                    <div class="review__avatar"><img src="../images/avatars/avatar-1.jpg" alt=""></div>
                                                    <div class="review__content">
                                                        <div class="review__author">
                                                            @foreach($users as $user)
                                                                @if($user->id == $vote->ref_user )
                                                                    {{ $user->name . " " . $user->surname }}
                                                                    @endif
                                                                @endforeach
                                                        </div>
                                                        <div class="review__rating">
                                                            <div class="rating">
                                                                <div class="rating__body">
                                                                    <?php
                                                                    $i = DB::table('product_vote')
                                                                        ->where('product_vote.id','=',$vote->id)
                                                                        ->where('product_vote.active','=',true)
                                                                        ->where('product_vote.ref_product','=',$product->id)
                                                                        ->avg('value');
                                                                    $numberofvotes = DB::table('product_vote')
                                                                        ->where('product_vote.id','=',$vote->id)
                                                                        ->where('product_vote.active','=',true)
                                                                        ->where('product_vote.ref_product','=',$product->id)
                                                                        ->Count();
                                                                    for($j = 1; $j<=5; $j++){
                                                                    if($j<=$i){
                                                                    ?>
                                                                    <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge rating__star--active">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }else{
                                                                    ?>
                                                                    <svg class="rating__star" width="13px" height="12px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review__text">
                                                            @if( $vote->comment == null)
                                                                <italic>Kullanıcı yorum yapmadan değerlendirme yapmıştır.</italic>
                                                            @else
                                                                {{ $vote->comment }}
                                                                @endif
                                                        </div>
                                                        <div class="review__date">{{ $vote->date }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                                @endif
                                        </ol>
                                    </div>
                                </div>
                                @if(auth()->check())
                                <form class="reviews-view__form" method="POST" action="{{ route('make_comment') }}">
                                    <input type="hidden" name="productid" id="productid" value="{{ $product->id }}">
                                    {{ csrf_field() }}
                                    <h3 class="reviews-view__header">Yorum Yapın</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-9 col-xl-8">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="review-stars">Puan</label>
                                                    <select id="rate" name="rate" class="form-control">
                                                        <option value="5" selected>5 Yıldız</option>
                                                        <option value="4">4 Yıldız</option>
                                                        <option value="3">3 Yıldız</option>
                                                        <option value="2">2 Yıldız</option>
                                                        <option value="1">1 Yıldız</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="review-author">Adınız ve Soyadınız</label>
                                                        <input type="text" class="form-control" id="review-author" placeholder="Adınız ve Soyadınız" value="{{ auth()->user()->name . " " . auth()->user()->surname }}" disabled>

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="review-email">Email Adresiniz</label>
                                                    <input type="text" class="form-control" id="review-email" placeholder="Email Adresiniz" value="{{ auth()->user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="review-text">Yorumunuz</label>
                                                <textarea class="form-control" id="yorum" name="yorum" rows="6"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg">Gönder</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    @else
                                    <br/>
                                    <br/>
                                <span>Ürünlere yorum yapabilmek için <a href="{{ route('user.login') }}">giriş</a> yapmanız gerekmektedir.</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .block-products-carousel -->
        <div class="block block-products-carousel" data-layout="grid-5" data-mobile-grid-columns="2">
            <div class="container">
                <div class="block-header">
                    <h3 class="block-header__title">Benzer Ürünler</h3>
                    <div class="block-header__divider"></div>
                    <div class="block-header__arrows-list">
                        <button class="block-header__arrow block-header__arrow--left" type="button">
                            <svg width="7px" height="11px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-left-7x11"></use>
                            </svg>
                        </button>
                        <button class="block-header__arrow block-header__arrow--right" type="button">
                            <svg width="7px" height="11px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-right-7x11"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="block-products-carousel__slider">
                    <div class="block-products-carousel__preloader"></div>
                    <div class="owl-carousel">
                        @foreach($_all_products as $_product)
                            @foreach($_product_categories as $_product_category)
                                @if($_product_category->ref_category == $product_category->ref_category && $_product->id == $_product_category->ref_product)
                                    @if($_product->id != $product->id)
                                    <div class="block-products-carousel__column">
                                        <div class="block-products-carousel__cell">
                                            <div class="product-card">
                                                <div class="product-card__image product-image">
                                                    <a href="{{ route('product',$_product->slug) }}" class="product-image__body">
                                                        <img class="product-image__img" src="{{ $_product->image }}" alt="{{ $_product->name }}">
                                                    </a>
                                                </div>
                                                <div class="product-card__info">
                                                    <div class="product-card__name">
                                                        <a href="{{ route('product',$_product->slug) }}">{{ $_product->name }} - {{ $_product->weight }} GR</a>
                                                    </div>
                                                    <div class="product-card__rating">
                                                        <div class="product-card__rating-stars">
                                                            <div class="rating">
                                                                <div class="rating__body">
                                                                    <?php
                                                                    $i = DB::table('product_vote')
                                                                        ->where('product_vote.active','=',true)
                                                                        ->where('product_vote.ref_product','=',$_product->id)
                                                                        ->avg('value');
                                                                    $numberofvotes = DB::table('product_vote')
                                                                        ->where('product_vote.active','=',true)
                                                                        ->where('product_vote.ref_product','=',$_product->id)
                                                                        ->Count();
                                                                    for($j = 1; $j<=5; $j++){
                                                                    if($j<=$i){
                                                                    ?>
                                                                    <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge rating__star--active">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }else{
                                                                    ?>
                                                                    <svg class="rating__star" width="13px" height="12px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="../images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="../images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-card__rating-legend">
                                                            <?php
                                                            if($i == 0){
                                                                echo "Değerlendirme Yok";
                                                            }else{
                                                                echo $numberofvotes . " Değerlendirme";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <ul class="product-card__features-list">
                                                        @foreach($_product_properties as $_product_property)
                                                            @if($_product_property->ref_product == $_product->id)
                                                            <li>{{ $_product_property->key }}: {{ $_product_property->value }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="product-card__actions">
                                                    <div class="product-card__availability">
                                                        @if($_product->stock == 1)
                                                            Stok Durumu: <span class="text-success">Stokta Var</span>
                                                        @endif
                                                        @if($_product->stock == 0)
                                                            Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-card__prices">
                                                        ₺{{ number_format($_product->price,2,',','.') }}
                                                    </div>
                                                    <div class="product-card__buttons">
                                                        <form action="{{ route('cart_ekle') }}" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" id="id" name="id" value="{{ $_product->id }}">
                                                            <input type="hidden" id="quantity" name="quantity" value="1">
                                                            <button class="btn btn-primary product-card__addtocart" type="submit" <?php if($_product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- .block-products-carousel / end -->
    </div>
    <!-- site__body / end -->
@endsection
