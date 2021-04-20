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
                            <li class="breadcrumb-item active" aria-current="page">Tüm Glutensiz Ürünler</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Glutensiz Mağaza</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="shop-layout shop-layout--sidebar--start">
                <div class="shop-layout__sidebar">
                    <div class="block block-sidebar block-sidebar--offcanvas--mobile">
                        <div class="block-sidebar__backdrop"></div>
                        <div class="block-sidebar__body">
                            <div class="block-sidebar__header">
                                <div class="block-sidebar__title">Glutensiz Mağaza</div>
                                <button class="block-sidebar__close" type="button">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="../images/sprite.svg#cross-20"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened">
                                    <h4 class="widget-filters__title widget__title">Glutensiz Kategoriler</h4>
                                    <div class="widget-filters__list">
                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item>
                                                <button type="button" class="filter__title" data-collapse-trigger>
                                                    Kategoriler
                                                    <svg class="filter__arrow" width="12px" height="7px">
                                                        <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                                <div class="filter__body" data-collapse-content>
                                                    <div class="filter__container">
                                                        <div class="filter-categories">
                                                            <ul class="filter-categories__list">
                                                                @foreach($categories as $category)
                                                                <li class="filter-categories__item filter-categories__item--parent">
                                                                    <a href="{{ route('shop.maincategory',$category->slug) }}">{{ $category->name }}</a>
                                                                    <div class="filter-categories__counter">
                                                                        @php
                                                                            $items = DB::table('category')
                                                                                        ->where('upperid',$category->id)
                                                                                        ->join('product_category','product_category.ref_category','=','category.id')
                                                                                        ->join('product','product.id','=','product_category.ref_product')
                                                                                        ->where('product.active','=',true)
                                                                                        ->Count();
                                                                            echo $items;
                                                                        @endphp
                                                                    </div>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item>
                                                <button type="button" class="filter__title" data-collapse-trigger>
                                                    Markalar
                                                    <svg class="filter__arrow" width="12px" height="7px">
                                                        <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                                <div class="filter__body" data-collapse-content>
                                                    <div class="filter__container">
                                                        <div class="filter-list">
                                                            <div class="filter-list__list">
                                                                @foreach($brands as $brand)
                                                                <label class="filter-list__item ">
                                                                        <span class="filter-list__input input-check">
                                                                            <span class="input-check__body">
                                                                                <input class="input-check__input" type="checkbox">
                                                                                <span class="input-check__box"></span>
                                                                                <svg class="input-check__icon" width="9px" height="7px">
                                                                                    <use xlink:href="../images/sprite.svg#check-9x7"></use>
                                                                                </svg>
                                                                            </span>
                                                                        </span>
                                                                    <span class="filter-list__title">{{ $brand->brand }}</span>
                                                                    <span class="filter-list__counter">
                                                                        @php
                                                                            $items = DB::table('product')
                                                                                        ->where('active',true)
                                                                                        ->where('brand',$brand->brand)
                                                                                        ->Count();
                                                                            echo $items;
                                                                        @endphp
                                                                    </span>
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-filters__item">
                                            <div class="filter filter--opened" data-collapse-item>
                                                <button type="button" class="filter__title" data-collapse-trigger>
                                                    Gramajlar
                                                    <svg class="filter__arrow" width="12px" height="7px">
                                                        <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                                                    </svg>
                                                </button>
                                                <div class="filter__body" data-collapse-content>
                                                    <div class="filter__container">
                                                        <div class="filter-list">
                                                            <div class="filter-list__list">
                                                                @foreach($weights as $weight)
                                                                <label class="filter-list__item">
                                                                        <span class="filter-list__input input-check">
                                                                            <span class="input-check__body">
                                                                                <input class="input-check__input" type="checkbox">
                                                                                <span class="input-check__box"></span>
                                                                                <svg class="input-check__icon" width="9px" height="7px">
                                                                                    <use xlink:href="../images/sprite.svg#check-9x7"></use>
                                                                                </svg>
                                                                            </span>
                                                                        </span>
                                                                    <span class="filter-list__title">{{ $weight->weight }} GR</span>
                                                                    <span class="filter-list__counter">
                                                                        @php
                                                                            $items = DB::table('product')
                                                                                        ->where('active',true)
                                                                                        ->where('weight',$weight->weight)
                                                                                        ->Count();
                                                                            echo $items;
                                                                        @endphp
                                                                    </span>
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-filters__actions d-flex">
                                        <button class="btn btn-primary btn-sm">Filtrele</button>
                                        <button class="btn btn-secondary btn-sm">Sıfırla</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-layout__content">
                    <div class="block">
                        <div class="products-view">
                            <div class="products-view__options">
                                <div class="view-options view-options--offcanvas--mobile">
                                    <div class="view-options__filters-button">
                                        <button type="button" class="filters-button">
                                            <svg class="filters-button__icon" width="16px" height="16px">
                                                <use xlink:href="../images/sprite.svg#filters-16"></use>
                                            </svg>
                                            <span class="filters-button__title">Filtre</span>
                                        </button>
                                    </div>
                                    <div class="view-options__layout">
                                        <div class="layout-switcher">
                                            <div class="layout-switcher__list">
                                                <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid" type="button" class="layout-switcher__button  layout-switcher__button--active ">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="../images/sprite.svg#layout-grid-16x16"></use>
                                                    </svg>
                                                </button>
                                                <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button ">
                                                    <svg width="16px" height="16px">
                                                        <use xlink:href="../images/sprite.svg#layout-list-16x16"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-options__legend"><strong>Mağazada {{ Count($products) }} adet ürün bulunmaktadır.</strong></div>
                                    <div class="view-options__divider"></div>
                                    <div class="view-options__control">
                                        <label>Sıralama</label>
                                        <div>
                                            <select class="form-control form-control-sm" name="" id="">
                                                <option value="">Varsayılan</option>
                                                <option value="">İsime Göre (A-Z)</option>
                                                <option value="">İsime Göre (Z-A)</option>
                                                <option value="">Fiyata Göre (Artan)</option>
                                                <option value="">Fiyata Göre (Azalan)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products-view__list products-list" data-layout="grid-3-sidebar" data-with-features="false" data-mobile-grid-columns="2">
                                <div class="products-list__body">
                                    @foreach($products as $product)
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__image product-image">
                                                <a href="{{ route('product',$product->slug) }}" class="product-image__body">
                                                    <img class="product-image__img" src="{{ $product->image }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__name">
                                                    <a href="{{ route('product',$product->slug) }}">{{ $product->name }} - {{ $product->weight }} GR</a>
                                                </div>
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
                                                                        <use xlink:href="images/sprite.svg#star-normal"></use>
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
                                                            echo "Değerlendirilme Yok";
                                                        }else{
                                                            echo $numberofvotes . " Değerlendirme";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <ul class="product-card__features-list">
                                                    {{ $product->description }}
                                                </ul>
                                            </div>
                                            <div class="product-card__actions">
                                                <div class="product-card__availability">
                                                    @if($product->stock == 1)
                                                        Stok Durumu: <span class="text-success">Stokta Var</span>
                                                    @endif
                                                    @if($product->stock == 0)
                                                        Stok Durumu: <span class="text-danger">Stokta Yok</span>
                                                    @endif
                                                </div>
                                                <div class="product-card__prices">
                                                    ₺{{ number_format($product->price, 2, ',', '.') }}
                                                </div>
                                                <div class="product-card__buttons">
                                                    <form action="{{ route('cart_ekle') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                                        <button class="btn btn-primary product-card__addtocart" type="submit" <?php if($product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
                                                        <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="submit" <?php if($product->stock == 0) echo "disabled"; ?>>Sepete Ekle</button>
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
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
