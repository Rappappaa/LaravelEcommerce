@extends('layouts.master')
@section('content')
<div class="site__body">
    <!-- .block-slideshow -->
    <div class="block-slideshow block-slideshow--layout--full block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block-slideshow__body">
                        <div class="owl-carousel">
                            @foreach($sliders as $slider)
                            <a class="block-slideshow__slide" href="{{ $slider->link }}">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{ $slider->desktop_image }}')"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{ $slider->mobile_image }}')"></div>
                                <div class="block-slideshow__slide-content">
                                    <div class="block-slideshow__slide-title">{{ $slider->title }}</div>
                                    <div class="block-slideshow__slide-text">{{ $slider->description }}</div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .block-slideshow / end -->
    <!-- .block-features -->
    <div class="block block-features block-features--layout--classic">
        <div class="container">
            <div class="block-features__list">
                <div class="block-features__item">
                    <div class="block-features__icon">
                        <svg width="48px" height="48px">
                            <use xlink:href="../images/sprite.svg#fi-free-delivery-48"></use>
                        </svg>
                    </div>
                    <div class="block-features__content">
                        <div class="block-features__title">Hızlı Gönderim</div>
                        <div class="block-features__subtitle">Siparişleriniz 48 saatte kapınızda!</div>
                    </div>
                </div>
                <div class="block-features__divider"></div>
                <div class="block-features__item">
                    <div class="block-features__icon">
                        <svg width="48px" height="48px">
                            <use xlink:href="../images/sprite.svg#fi-24-hours-48"></use>
                        </svg>
                    </div>
                    <div class="block-features__content">
                        <div class="block-features__title">Destek Hattı</div>
                        <div class="block-features__subtitle">Dilediğiniz zaman arayın</div>
                    </div>
                </div>
                <div class="block-features__divider"></div>
                <div class="block-features__item">
                    <div class="block-features__icon">
                        <svg width="48px" height="48px">
                            <use xlink:href="../images/sprite.svg#fi-payment-security-48"></use>
                        </svg>
                    </div>
                    <div class="block-features__content">
                        <div class="block-features__title">100% Güvenli</div>
                        <div class="block-features__subtitle">Güvenli online Ödeme Seçenekleri</div>
                    </div>
                </div>
                <div class="block-features__divider"></div>
                <div class="block-features__item">
                    <div class="block-features__icon">
                        <svg width="48px" height="48px">
                            <use xlink:href="../images/sprite.svg#fi-tag-48"></use>
                        </svg>
                    </div>
                    <div class="block-features__content">
                        <div class="block-features__title">Taze & Leziz</div>
                        <div class="block-features__subtitle">Günlük Glutensiz Kuruyemiş</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .block-features / end -->
    <!-- .block-products-carousel -->
    <div class="block block-products-carousel" data-layout="grid-4" data-mobile-grid-columns="2">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">Öne Çıkan Ürünler</h3>
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
                    @foreach($featureds as $featured)
                    <div class="block-products-carousel__column">
                        <div class="block-products-carousel__cell">
                            <div class="product-card">
                                <div class="product-card__image product-image">
                                    <a href="{{ route('product',$featured->slug) }}" class="product-image__body">
                                        <img class="product-image__img" src="{{ $featured->image }}" alt="{{ $featured->name }} - {{ $featured->weight}} GR">
                                    </a>
                                </div>
                                <div class="product-card__info">
                                    <div class="product-card__name">
                                        <a href="{{ route('product',$featured->slug) }}">{{ $featured->name }} - {{ $featured->weight}} GR</a>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="product-card__rating-stars">
                                            <div class="rating">
                                                <div class="rating__body">
                                                    <?php
                                                    $i = DB::table('product_vote')
                                                        ->where('product_vote.active','=',true)
                                                        ->where('product_vote.ref_product','=',$featured->id)
                                                        ->avg('value');
                                                    $numberofvotes = DB::table('product_vote')
                                                        ->where('product_vote.active','=',true)
                                                        ->where('product_vote.ref_product','=',$featured->id)
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
                                </div>
                                <div class="product-card__actions">
                                    <div class="product-card__availability">
                                        @if($featured->stock == 1)
                                            Stok Durumu: <span class="text-success">Stokta Var</span>
                                        @endif
                                        @if($featured->stock == 0)
                                            Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                        @endif
                                    </div>
                                    <div class="product-card__prices">
                                        ₺{{ number_format($featured->price, 2, ',', '.') }}
                                    </div>
                                    <div class="product-card__buttons">
                                        <form action="{{ route('cart_ekle') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="id" name="id" value="{{ $featured->id }}">
                                            <input type="hidden" id="quantity" name="quantity" value="1">
                                        <button class="btn btn-primary product-card__addtocart" type="submit"  <?php if($featured->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                        <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit" <?php if($featured->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach()
                </div>
            </div>
        </div>
    </div>
    <!-- .block-products-carousel / end -->
    <!-- .block-banner -->
    <div class="block block-banner">
        <div class="container">
            <a class="block-banner__body">
                <div class="block-banner__image block-banner__image--desktop" style="background-image: url('../images/banners/home-banner-buyuk.png')"></div>
                <div class="block-banner__image block-banner__image--mobile" style="background-image: url('../images/banners/home-banner-kucuk.png')"></div>
                <div class="block-banner__title" style="color: white">Arzu Kuruyemiş olarakta burdayız!</div></br>
                <div class="block-banner__text" style="color: white">Dilerseniz mağazamızda standart olarak bulunan diğer kuruyemişlerdende sipariş verebilirsiniz. Ayrıntılı bilgi için lütfen arayınız.</div>
            </a>
        </div>
    </div>
    <!-- .block-banner / end -->
    <!-- .block-products -->
    <div class="block block-products block-products--layout--large-first" data-mobile-grid-columns="2">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">En Çok Satanlar</h3>
                <div class="block-header__divider"></div>
            </div>
            <div class="block-products__body">
                <div class="block-products__featured">
                    <!-- Tek Büyük Ürün -->
                    <div class="block-products__featured-item">
                        <div class="product-card">
                            <div class="product-card__image product-image">
                                <a href="{{ route('product',$single_product->slug) }}" class="product-image__body">
                                    <img class="product-image__img" src="{{ $single_product->image }}" alt="{{ $single_product->name }} - {{ $single_product->weight}} GR">
                                </a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name">
                                    <a href="{{ route('product',$single_product->slug) }}">{{ $single_product->name }} - {{ $single_product->weight }} GR</a>
                                </div>
                                <div class="product-card__rating">
                                    <div class="product-card__rating-stars">
                                        <div class="rating">
                                            <div class="rating__body">
                                                <?php
                                                $i = DB::table('product_vote')
                                                    ->where('product_vote.active','=',true)
                                                    ->where('product_vote.ref_product','=',$single_product->id)
                                                    ->avg('value');
                                                $numberofvotes = DB::table('product_vote')
                                                    ->where('product_vote.active','=',true)
                                                    ->where('product_vote.ref_product','=',$single_product->id)
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
                            </div>
                            <div class="product-card__actions">
                                <div class="product-card__availability">
                                    @if($single_product->stock == 1)
                                        Stok Durumu: <span class="text-success">Stokta Var</span>
                                    @endif
                                    @if($single_product->stock == 0)
                                        Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                    @endif
                                </div>
                                <div class="product-card__prices">
                                    ₺{{ number_format($single_product->price, 2, ',', '.') }}
                                </div>
                                <div class="product-card__buttons">
                                    <form action="{{ route('cart_ekle') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="id" name="id" value="{{ $single_product->id }}">
                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                    <button class="btn btn-primary product-card__addtocart" type="submit" <?php if($single_product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                    <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit" <?php if($single_product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-products__list">
                    <!-- Normal Ürünler 6 adet çekilecek-->
                    @foreach($most_sellers as $most_seller)
                    <div class="block-products__list-item">
                        <div class="product-card">
                            <div class="product-card__image product-image">
                                <a href="{{ route('product',$most_seller->slug) }}" class="product-image__body">
                                    <img class="product-image__img" src="{{ $most_seller->image }}" alt="{{ $single_product->name }} - {{ $single_product->weight}} GR">
                                </a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name">
                                    <a href="{{ route('product',$most_seller->slug) }}">{{ $most_seller->name }} - {{ $most_seller->weight }} GR</a>
                                </div>
                                <div class="product-card__rating">
                                    <div class="product-card__rating-stars">
                                        <div class="rating">
                                            <div class="rating__body">
                                                <?php
                                                $i = DB::table('product_vote')
                                                    ->where('product_vote.active','=',true)
                                                    ->where('product_vote.ref_product','=',$most_seller->id)
                                                    ->avg('value');
                                                $numberofvotes = DB::table('product_vote')
                                                    ->where('product_vote.active','=',true)
                                                    ->where('product_vote.ref_product','=',$most_seller->id)
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
                            </div>
                            <div class="product-card__actions">
                                <div class="product-card__availability">
                                    @if($most_seller->stock == 1)
                                        Stok Durumu: <span class="text-success">Stokta Var</span>
                                    @endif
                                    @if($most_seller->stock == 0)
                                        Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                    @endif
                                </div>
                                <div class="product-card__prices">
                                    ₺{{ number_format($most_seller->price, 2, ',', '.') }}
                                </div>
                                <div class="product-card__buttons">
                                    <form action="{{ route('cart_ekle') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="id" name="id" value="{{ $most_seller->id }}">
                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                    <button class="btn btn-primary product-card__addtocart" type="submit" <?php if($most_seller->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                    <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit" <?php if($most_seller->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- .block-products / end -->
    <!-- .block-categories -->
    <div class="block block--highlighted block-categories block-categories--layout--classic">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">Popüler Kategoriler</h3>
                <div class="block-header__divider"></div>
            </div>
            <div class="block-categories__list">
            @foreach($_categories as $_category)
                <!-- Polpüler Kategoriler 6 adet çekilecek-->
                <div class="block-categories__item category-card category-card--layout--classic">
                    <div class="category-card__body">
                        <div class="category-card__image">
                            <a href="{{ route('shop.maincategory',$_category->slug) }}"><img src="{{ $_category->image }}" alt="{{ $_category->description }}"></a>
                        </div>
                        <div class="category-card__content">
                            <div class="category-card__name">
                                <a href="{{ route('shop.maincategory',$_category->slug) }}">{{ $_category->name }}</a>
                            </div>
                                <ul class="category-card__links">
                                    @foreach($_sub_categories as $_sub_category)
                                        @if($_sub_category->upperid == $_category->id)
                                            <li>
                                                <a href="{{ route('shop.maincategory',$_sub_category->slug) }}">{{ $_sub_category->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            <div class="category-card__all">
                                <a href="{{ route('shop.maincategory',$_category->slug) }}">Tümünü Göster</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- .block-categories / end -->
    <!-- .block-products-carousel -->
    <div class="block block-products-carousel" data-layout="horizontal" data-mobile-grid-columns="2">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">Yeni Gelenler</h3>
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
                    @php $sayac = 0; @endphp
                    @foreach($new_arrivals as $new_arrival)
                        <div class="block-products-carousel__column">
                            <div class="block-products-carousel__cell">
                                <div class="product-card">
                                    <div class="product-card__image product-image">
                                        <a href="{{ route('product',$new_arrival->slug) }}" class="product-image__body">
                                            <img class="product-image__img" src="{{ $new_arrival->image }}" alt="{{ $new_arrival->name }}">
                                        </a>
                                    </div>
                                    <div class="product-card__info">
                                        <div class="product-card__name">
                                            <a href="{{ route('product',$new_arrival->slug) }}">{{ $new_arrival->name }} {{ $new_arrival->weight }}GR</a>
                                        </div>
                                        <div class="product-card__rating">
                                            <div class="product-card__rating-stars">
                                                <div class="rating">
                                                    <div class="rating__body">
                                                        <?php
                                                        $i = DB::table('product_vote')
                                                            ->where('product_vote.active','=',true)
                                                            ->where('product_vote.ref_product','=',$new_arrival->id)
                                                            ->avg('value');
                                                        $numberofvotes = DB::table('product_vote')
                                                            ->where('product_vote.active','=',true)
                                                            ->where('product_vote.ref_product','=',$new_arrival->id)
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
                                    </div>
                                    <div class="product-card__actions">
                                        <div class="product-card__availability">
                                            @if($new_arrival->stock == 1)
                                                Stok Durumu: <span class="text-success">Stokta Var</span>
                                            @endif
                                            @if($new_arrival->stock == 0)
                                                Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                            @endif
                                        </div>
                                        <div class="product-card__prices">
                                            ₺{{ number_format($new_arrival->price, 2, ',', '.') }}
                                        </div>
                                        <div class="product-card__buttons">
                                            <button class="btn btn-primary product-card__addtocart" type="submit" <?php if($new_arrival->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                            <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit" <?php if($new_arrival->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="block block-brands">
        <div class="container">
            <div class="block-brands__slider">
                <div class="owl-carousel">
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-1.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-2.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-3.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-4.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-5.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-6.png" alt=""></a>
                    </div>
                    <div class="block-brands__item">
                        <a><img src="../images/logos/logo-7.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- .block-posts -->
    <div class="block block-posts" data-layout="list" data-mobile-columns="1">
        <div class="container">
            <div class="block-header">
                <h3 class="block-header__title">Son Blog Yazıları</h3>
                <div class="block-header__divider"></div>
            </div>
            <div class="block-posts__slider">
                <div class="owl-carousel">
                    @if(Count($blogs)<1)
                        Henüz blog yazısı eklenmemiştir.
                    @else
                        @foreach($blogs as $blog)
                        <div class="post-card">
                            <div class="post-card__image">
                                <a href="">
                                    <img src="" alt="{{ $blog->header }}">
                                </a>
                            </div>
                            <div class="post-card__info">
                                <div class="post-card__category">
                                    <a href="">{{ $blog->ref_category }}</a>
                                </div>
                                <div class="post-card__name">
                                    <a href="">{{ $blog->header }}</a>
                                </div>
                                <div class="post-card__date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->blogdate)->format('M d Y') }}</div>
                                <div class="post-card__content">
                                    {{ $blog->icerik }}
                                </div>
                                <div class="post-card__read-more">
                                    <a href="" class="btn btn-secondary btn-sm">Devamını oku..</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- .block-posts / end -->
</div>
@endsection
