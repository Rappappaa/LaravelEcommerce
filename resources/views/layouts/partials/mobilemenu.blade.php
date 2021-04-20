<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title">Menü</div>
            <button type="button" class="mobilemenu__close">
                <svg width="20px" height="20px">
                    <use xlink:href="../images/sprite.svg#cross-20"></use>
                </svg>
            </button>
        </div>
        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">
                <!-- Ana Sayfa -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="{{ route('home') }}" class="mobile-links__item-link">Ana Sayfa</a>
                    </div>
                </li>
                <!-- Mağaza -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="{{ route('shop') }}" class="mobile-links__item-link">Mağaza</a>
                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    @foreach($_categories as $_category)
                        @if($_category->upperid == null && $_category->type == 0)
                            <div class="mobile-links__item-sub-links" data-collapse-content>
                                <ul class="mobile-links mobile-links--level--1">
                                    <li class="mobile-links__item" data-collapse-item>
                                        <div class="mobile-links__item-title">
                                            <a href="{{ route('shop.maincategory',$_category->slug)  }}" class="mobile-links__item-link">{{ $_category->name }}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </li>
                <!-- Blog -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="{{ route('blog') }}" class="mobile-links__item-link">Blog</a>
                    </div>
                </li>
                <!-- İletişim -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a href="{{ route('contact') }}" class="mobile-links__item-link">İletişim</a>
                    </div>
                </li>
                <!-- Bilgilendirme -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a class="mobile-links__item-link">Bilgilendirme</a>
                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-links__item-sub-links" data-collapse-content>
                        <ul class="mobile-links mobile-links--level--1">
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('aboutus') }}" class="mobile-links__item-link">Hakkımızda</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('mss') }}" class="mobile-links__item-link">Mesafeli Satış Sözleşmesi</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('privacy') }}" class="mobile-links__item-link">Gizlilik Politikamız</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('salepoints') }}" class="mobile-links__item-link">Satış Noktalarımız</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('delivery') }}" class="mobile-links__item-link">Kargo & Teslimat</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('sitemap') }}" class="mobile-links__item-link">Site Haritası</a>
                                </div>
                            </li>
                        </ul>
                </div>
                </li>
                <!-- Kurumsal -->
                <li class="mobile-links__item" data-collapse-item>
                    <div class="mobile-links__item-title">
                        <a class="mobile-links__item-link">Kurumsal</a>
                        <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                            <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-links__item-sub-links" data-collapse-content>
                        <ul class="mobile-links mobile-links--level--1">
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('partnership') }}" class="mobile-links__item-link">İş Ortaklığı</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('sponsorship') }}" class="mobile-links__item-link">Sponsorluk</a>
                                </div>
                            </li>
                            <li class="mobile-links__item" data-collapse-item>
                                <div class="mobile-links__item-title">
                                    <a href="{{ route('distributor') }}" class="mobile-links__item-link">Bayilik</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Kullanıcı Kayıt/Giriş-->
                @guest
                    <li class="mobile-links__item" data-collapse-item>
                        <div class="mobile-links__item-title">
                            <a href="{{ route('user.register') }}" class="mobile-links__item-link">Kayıt Ol</a>
                        </div>
                    </li>
                    <li class="mobile-links__item" data-collapse-item>
                        <div class="mobile-links__item-title">
                            <a href="{{ route('user.login') }}" class="mobile-links__item-link">Giriş Yap</a>
                        </div>
                    </li>
                @endguest
                @auth
                    <li class="mobile-links__item" data-collapse-item>
                        <div class="mobile-links__item-title">
                            <a class="mobile-links__item-link">Hesabım</a>
                            <button class="mobile-links__item-toggle" type="button" data-collapse-trigger>
                                <svg class="mobile-links__item-arrow" width="12px" height="7px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-down-12x7"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="mobile-links__item-sub-links" data-collapse-content>
                            <ul class="mobile-links mobile-links--level--1">
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ route('user.dashboard') }}" class="mobile-links__item-link">Genel Bakış</a>
                                    </div>
                                </li>
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ route('user.profile') }}" class="mobile-links__item-link">Profilim</a>
                                    </div>
                                </li>
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ route('user.orders') }}" class="mobile-links__item-link">Siparişlerim</a>
                                    </div>
                                </li>
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ route('user.address') }}" class="mobile-links__item-link">Adreslerim</a>
                                    </div>
                                </li>
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="{{ route('user.change_password') }}" class="mobile-links__item-link">Şifre Değiştirme</a>
                                    </div>
                                </li>
                                <li class="mobile-links__item" data-collapse-item>
                                    <div class="mobile-links__item-title">
                                        <a href="#"  class="mobile-links__item-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                                        <form id="logout-form" action="{{ route('user.logout') }}" method="post" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
