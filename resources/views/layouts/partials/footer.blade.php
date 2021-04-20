<footer class="site__footer">
    <div class="site-footer">
        <div class="container">
            <div class="site-footer__widgets">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-contacts">
                            <h5 class="footer-contacts__title">Biz Kimiz?</h5>
                            <div class="footer-contacts__text">
                                <strong>GFree</strong> beslenme alışkanlığına dikkat eden kişiler için yaratılmış bir <strong>Glutensiz Kuruyemiş</strong> markasıdır.
                                Eğer sizde beslenmenizdeki ürünlere dikkat ediyor, sağlıklı, taze ve organik ürün tüketmeye gayret ediyorsanız doğru adrestesiniz.
                                Kurulduğumuz ilk günden itibaren aynı zevk ve heyecanla sizlere hizmet vermekten mutluluk duyuyoruz!
                            </div>
                            <ul class="footer-contacts__contacts">
                                <li><i class="footer-contacts__icon fas fa-globe-americas"></i> Gülabibey Mah. Cemilbey Cad. No:69/A ÇORUM</li>
                                <li><i class="footer-contacts__icon far fa-envelope"></i> info@glutensizkuruyemis.com</li>
                                <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> +90 530 971 19 00</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="site-footer__widget footer-links">
                            <h5 class="footer-links__title">Bilgilendirme</h5>
                            <ul class="footer-links__list">
                                <li class="footer-links__item"><a href="{{ route('aboutus') }}" class="footer-links__link">Hakkımızda</a></li>
                                <li class="footer-links__item"><a href="{{ route('contact') }}" class="footer-links__link">İletişim</a></li>
                                <li class="footer-links__item"><a href="{{ route('salepoints') }}"  class="footer-links__link">Satış Noktalarımız</a></li>
                                <li class="footer-links__item"><a href="{{ route('blog') }}"  class="footer-links__link">Blog</a></li>
                                <li class="footer-links__item"><a href="{{ route('mss') }}"  class="footer-links__link">Mesafeli Satış Sözleşmesi</a></li>
                                <li class="footer-links__item"><a href="{{ route('privacy') }}"  class="footer-links__link">Gizlilik Politikamız</a></li>
                                <li class="footer-links__item"><a href="{{ route('delivery') }}"  class="footer-links__link">Kargo & Teslimat</a></li>
                                <li class="footer-links__item"><a href="{{ route('sitemap') }}"  class="footer-links__link">Site Haritası</a></li>
                            </ul><br>
                            <h5 class="footer-links__title">Kurumsal</h5>
                            <ul class="footer-links__list">
                                <li class="footer-links__item"><a href="{{ route('partnership') }}"  class="footer-links__link">İş Ortaklığı</a></li>
                                <li class="footer-links__item"><a href="{{ route('sponsorship') }}"  class="footer-links__link">Sponsorluk</a></li>
                                <li class="footer-links__item"><a href="{{ route('distributor') }}"  class="footer-links__link">Bayilik</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="site-footer__widget footer-links">
                            <h5 class="footer-links__title">Kategoriler</h5>
                            <ul class="footer-links__list">
                                @foreach($_categories as $_category)
                                <li class="footer-links__item"><a href="{{ route('shop.maincategory',$_category->slug) }}" class="footer-links__link">{{ $_category->name }}</a></li>
                                @endforeach
                            </ul><br>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="site-footer__widget footer-newsletter">
                            <h5 class="footer-newsletter__title">Haberler</h5>
                            <div class="footer-newsletter__text">
                                Son eklenen ürünlerimizden ve blog yazılarımızdan haberdar olmak için lütfen e-mail sistemimize kayıt olun
                            </div>
                            <form action="" class="footer-newsletter__form">
                                <label class="sr-only" for="footer-newsletter-address">E-mail Adresiniz</label>
                                <input type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="E-mail Adresiniz...">
                                <button class="footer-newsletter__form-button btn btn-primary">Kayıt</button>
                            </form>
                            <div class="footer-newsletter__text footer-newsletter__text--social">
                                Sosyal Medyada Bizi Takip Edin
                            </div>
                            <!-- social-links -->
                            <div class="social-links footer-newsletter__social-links social-links--shape--circle">
                                <ul class="social-links__list">
                                    <li class="social-links__item">
                                        <a class="social-links__link social-links__link--type--rss" href="" target="_blank">
                                            <i class="fas fa-rss"></i>
                                        </a>
                                    </li>
                                    <li class="social-links__item">
                                        <a class="social-links__link social-links__link--type--youtube" href="" target="_blank">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="social-links__item">
                                        <a class="social-links__link social-links__link--type--facebook" href="https://www.facebook.com/CorumArzuKuruyemis" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-links__item">
                                        <a class="social-links__link social-links__link--type--twitter" href="" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-links__item">
                                        <a class="social-links__link social-links__link--type--instagram" href="https://www.instagram.com/arzukuruyemis/" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- social-links / end -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="site-footer__copyright">
                    <!-- copyright -->
                    Powered by <a href="https://www.linkedin.com/in/kadir-yildirim/" target="_blank">Kadir YILDIRIM</a>
                    <!-- copyright / end -->
                </div>
                <div class="site-footer__payments">
                    <img src="../images/logos/footer_ssl.webp" alt="Güvenli Ödeme Seçenekleri">
                </div>
            </div>
        </div>
        <div class="totop">
            <div class="totop__body">
                <div class="totop__start"></div>
                <div class="totop__container container"></div>
                <div class="totop__end">
                    <button type="button" class="totop__button">
                        <svg width="13px" height="8px">
                            <use xlink:href="../images/sprite.svg#arrow-rounded-up-13x8"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>
