<header class="site__header d-lg-block d-none">
<div class="site-header">
<!-- .topbar -->
<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ route('aboutus') }}">Hakkımızda</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ route('contact') }}">İletişim</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ route('salepoints') }}">Satış Noktalarımız</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ route('blog') }}">Blog</a>
            </div>
            <div class="topbar__spring"></div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                    <button class="topbar-dropdown__btn" type="button">
                        Dil: <span class="topbar__item-value">Türkçe</span>
                        <svg width="7px" height="5px">
                            <use xlink:href="../images/sprite.svg#arrow-rounded-down-7x5"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <div class="menu menu--layout--topbar  menu--with-icons ">
                            <div class="menu__submenus-container"></div>
                            <ul class="menu__list">
                                <!-- Languages -->
                                <li class="menu__item">
                                    <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                    <a class="menu__item-link" href="">Türkçe</a>
                                </li>
                            </ul>
                        </div>
                        <!-- .menu / end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .topbar / end -->
<div class="site-header__middle container">
    <div class="site-header__logo">
        <a href="{{ route('home') }}">
            <!-- logo -->
                <image src="../images/logo.png" width="196px"></image>
            <!-- logo / end -->
        </a>
    </div>
    <div class="site-header__search">
        <div class="search search--location--header ">
            <div class="search__body">
                <!-- Search -->
                <form class="search__form" action="">
                    <input class="search__input" name="search" placeholder="Yüzlerce ürün arasından aradığınızı bulun..." aria-label="Site search" type="text" autocomplete="on">
                    <button class="search__button search__button--type--submit" type="submit">
                        <svg width="20px" height="20px">
                            <use xlink:href="../images/sprite.svg#search-20"></use>
                        </svg>
                    </button>
                    <div class="search__border"></div>
                </form>
                <div class="search__suggestions suggestions suggestions--location--header"></div>
            </div>
        </div>
    </div>
    <div class="site-header__phone">
        <div class="site-header__phone-title">Müşteri Hizmetleri</div>
        <div class="site-header__phone-number">+90 530 971 19 00</div>
    </div>
</div>
<div class="site-header__nav-panel">
    <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
    <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
        <div class="nav-panel__container container">
            <div class="nav-panel__row">
                <div class="nav-panel__departments">
                    <!-- .departments -->
                    <div class="departments " data-departments-fixed-by="">
                        <div class="departments__body">
                            <div class="departments__links-wrapper">
                                <div class="departments__submenus-container"></div>
                                <ul class="departments__links">
                                    <!-- Çoklu Menü -->
                                    @foreach($_categories as $_category)
                                        @if($_category->upperid == null && $_category->type == 0)
                                            <li class="departments__item">
                                                <a class="departments__item-link" href="{{ route('shop.maincategory',$_category->slug) }}">
                                                    {{ $_category->name }}
                                                    <svg class="departments__item-arrow" width="6px" height="9px">
                                                        <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                    </svg>
                                                </a>
                                                <div class="departments__submenu departments__submenu--type--menu">
                                                    <!-- .menu -->
                                                    <div class="menu menu--layout--classic ">
                                                        <div class="menu__submenus-container"></div>
                                                        <ul class="menu__list">
                                                            @foreach($_sub_categories as $_sub_category)
                                                                @if($_category->id == $_sub_category->upperid)
                                                            <li class="menu__item">
                                                                <!-- This is a synthetic element that allows to adjust the vertical offset of the submenu using CSS. -->
                                                                <div class="menu__item-submenu-offset"></div>
                                                                <a class="menu__item-link" href="{{ route('shop.maincategory',$_sub_category->slug) }}">
                                                                    {{ $_sub_category->name }}
                                                                </a>
                                                            </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <!-- .menu / end -->
                                                </div>
                                            </li>
                                        @endif
                                    <!-- Tekli Menü -->
                                        @if($_category->upperid == null && $_category->type == 1)
                                            <li class="departments__item">
                                                <a class="departments__item-link" href="{{ route('shop.maincategory',$_category->slug) }}">
                                                    {{ $_category->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button class="departments__button">
                            <svg class="departments__button-icon" width="18px" height="14px">
                                <use xlink:href="../images/sprite.svg#menu-18x14"></use>
                            </svg>
                            Glutensiz Kategoriler
                            <svg class="departments__button-arrow" width="9px" height="6px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-down-9x6"></use>
                            </svg>
                        </button>
                    </div>
                    <!-- .departments / end -->
                </div>
                <!-- .nav-links -->
                <div class="nav-panel__nav-links nav-links">
                    <ul class="nav-links__list">
                        <li class="nav-links__item ">
                            <div class="nav-links__item-link">
                                Aradığınız tüm Glutensiz ürünleri bir arada bulabileceğiniz adres
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- .nav-links / end -->
                <div class="nav-panel__indicators">
                    @auth
                    <div class="indicator indicator--trigger--click">
                        <a class="indicator__button">
                            <span class="indicator__area">
                                <svg width="20px" height="20px">
                                    <use xlink:href="../images/sprite.svg#cart-20"></use>
                                </svg>
                                <span class="indicator__value">
                                    @php
                                        $items = DB::table('basket_item')->where(['ref_user' => auth()->user()->id, 'ref_basket' => null])->Count();
                                        echo $items;
                                    @endphp
                                </span>
                            </span>
                        </a>
                        <div class="indicator__dropdown">
                            <!-- Sepet -->
                            <div class="dropcart dropcart--style--dropdown">
                                @if(DB::table('basket_item')->where(['ref_user' => auth()->user()->id, 'ref_basket' => null])->Count() == null)
                                    <div class="dropcart__body">
                                        <div class="dropcart__products-list">
                                            Sepetinizde henüz ürün bulunmuyor.
                                        </div>
                                    </div>
                                @else
                                    <div class="dropcart__body">
                                        @foreach($items = DB::table('basket_item')
    ->join('product','basket_item.ref_product' , '=', 'product.id')
    ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get() as $items)
                                            <div class="dropcart__products-list">
                                                <div class="dropcart__product">
                                                    <div class="product-image dropcart__product-image">
                                                        <a href="{{ route('product',$items->slug) }}" class="product-image__body">
                                                            <img class="product-image__img" src="{{ $items->image }}" alt="{{ $items->name }}">
                                                        </a>
                                                    </div>
                                                    <div class="dropcart__product-info">
                                                        <div class="dropcart__product-name"><a href="{{ route('product',$items->slug) }}">{{ $items->name }} {{ $items->weight }}GR</a></div>
                                                        <ul class="dropcart__product-options">
                                                            <li>{{ $items->quantity }} Adet</li>
                                                            <li>Birim Fiyatı: ₺{{ number_format($items->itemprice,2,',','.') }}</li>
                                                        </ul>
                                                        <div class="dropcart__product-meta">
                                                            <span style="font-size: 14px;">Tutar: ₺{{ number_format($items->itemprice * $items->quantity,2,',','.') }}</span>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('cart_kaldir') }}" METHOD="post">
                                                        <input type="hidden" id="urunid" name="urunid" value="{{ $items->id }}">
                                                        {{ csrf_field() }}
                                                    <button type="submit" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                                                        <svg width="10px" height="10px">
                                                            <use xlink:href="../images/sprite.svg#cross-10"></use>
                                                        </svg>
                                                    </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="dropcart__totals">
                                            <table>
                                                @php
                                                    $uruntutari =0;
                                                        foreach($items = DB::table('basket_item')
                                                            ->join('product','basket_item.ref_product' , '=', 'product.id')
                                                            ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get() as $items){
                                                            $uruntutari += $items->price * $items->quantity;
                                                            }
                                                        echo "<tr>";
                                                        echo "<th>Toplam</th>";
                                                        echo "<td> ₺" . number_format($uruntutari,2,',','.') . "</td>";
                                                        echo "</tr>";
                                                @endphp
                                            </table>
                                        </div>
                                        <div class="dropcart__buttons">
                                            <a class="btn btn-secondary" href="{{ route('cart') }}">Sepete Git</a>
                                            <a class="btn btn-primary" href="{{ route('completeorder') }}">Ödeme Yap</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Sepet / end -->
                        </div>
                    </div>
                    @endauth
                    <div class="indicator indicator--trigger--click">
                        <a class="indicator__button">
                            <span class="indicator__area">
                                <svg width="20px" height="20px">
                                    <use xlink:href="../images/sprite.svg#person-20"></use>
                                </svg>
                            </span>
                        </a>
                        <div class="indicator__dropdown">
                            <div class="account-menu">
                                @guest
                                    <form action="{{ route('user.login') }}" method="POST" class="account-menu__form">
                                        {{ csrf_field() }}
                                        <div class="account-menu__form-title">Giriş Yap</div>
                                        <div class="form-group">
                                            <label for="header-signin-email" class="sr-only">Email adresiniz</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Email adresiniz">
                                        </div>
                                        <div class="form-group">
                                            <label for="header-signin-password" class="sr-only">Şifreniz</label>
                                            <div class="account-menu__form-forgot">
                                                <input id="password" name="password" type="password"  class="form-control form-control-sm" placeholder="Şifreniz">
                                                <!-- <a href="{{ route('user.forgot_password') }}" class="account-menu__form-forgot-link">Şifremi Unuttum?</a> -->
                                            </div>
                                        </div>
                                        <div class="form-group account-menu__form-button">
                                            <button type="submit" class="btn btn-primary btn-sm">Giriş Yap</button>
                                        </div>
                                        <div class="account-menu__form-link"><a href="{{ route('user.register') }}">Hesap Oluştur</a></div>
                                    </form>
                                @endguest
                                @auth
                                    <a class="account-menu__user">
                                        <div class="account-menu__user-avatar">
                                            <svg width="24px" height="24px">
                                                <use xlink:href="../images/sprite.svg#person-20"></use>
                                            </svg>
                                        </div>
                                        <div class="account-menu__user-info">
                                            <div class="account-menu__user-name">{{ auth()->user()->name }} {{ auth()->user()->surname }}</div>
                                            <div class="account-menu__user-email">{{ auth()->user()->email }}</div>
                                        </div>
                                    </a>
                                    <div class="account-menu__divider"></div>
                                    <ul class="account-menu__links">
                                        <li><a href="{{ route('user.dashboard') }}">Genel Bakış</a></li>
                                        <li><a href="{{ route('user.profile') }}">Profilim</a></li>
                                        <li><a href="{{ route('user.orders') }}">Siparişlerim</a></li>
                                        <li><a href="{{ route('user.address') }}">Adreslerim</a></li>
                                        <li><a href="{{ route('user.change_password') }}">Şifre Değiştirme</a></li>
                                    </ul>
                                    <div class="account-menu__divider"></div>
                                    <ul class="account-menu__links">
                                        <li>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                                            <form id="logout-form" action="{{ route('user.logout') }}" method="post" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</header>
