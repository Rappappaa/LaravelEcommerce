@extends('layouts.master')
@section('title',config('app.name') . ' - Blog')
@section('content')
    <!-- site -->
    <div class="site">
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
                                    <a href="{{ route('blog') }}">Glutensiz Blog</a>
                                    <svg class="breadcrumb-arrow" width="6px" height="9px">
                                        <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                    </svg>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tüm Blog Yazıları</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header__title">
                        <h1>Tüm Blog Yazıları</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 order-1 order-lg-0">
                        <div class="block block-sidebar block-sidebar--position--start">
                            <div class="block-sidebar__item">
                                <div class="widget-search">
                                    <form class="widget-search__body">
                                        <input class="widget-search__input" placeholder="Blogta arayın" type="text" autocomplete="on" spellcheck="false">
                                        <button class="widget-search__button" type="submit">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="../images/sprite.svg#search-20"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-categories widget-categories--location--blog widget">
                                    <h4 class="widget__title">Kategoriler</h4>
                                    <ul class="widget-categories__list" data-collapse data-collapse-opened-class="widget-categories__item--open">
                                        @foreach($blog_categories as $blog_category)
                                            <li class="widget-categories__item" data-collapse-item>
                                                <div class="widget-categories__row">
                                                    <a href="{{ route('blog.category',$blog_category->slug) }}">
                                                        <svg class="widget-categories__arrow" width="6px" height="9px">
                                                            <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                                        </svg>
                                                        {{ $blog_category->name }}
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-posts widget">
                                    <h4 class="widget__title">Son Yazılar</h4>
                                    <div class="widget-posts__list">
                                        <div class="widget-posts__item">
                                            <div class="widget-posts__image">
                                                <a href="">
                                                    <img src="images/posts/post-1-thumbnail.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="widget-posts__info">
                                                <div class="widget-posts__name">
                                                    <a href="">Başlık</a>
                                                </div>
                                                <div class="widget-posts__date">Kategori</div>
                                                <div class="widget-posts__date">October 19, 2019</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="block-sidebar__item">
                                <div class="widget-comments widget">
                                    <h4 class="widget__title">En Son Yorumlar</h4>
                                    <ul class="widget-comments__list">
                                        <li class="widget-comments__item">
                                            <div class="widget-comments__author"><a href="">Kullanıcı adı</a></div>
                                            <div class="widget-comments__content">Az  bişi yorumu...</div>
                                            <div class="widget-comments__meta">
                                                <div class="widget-comments__date">3 minutes ago</div>
                                                <div class="widget-comments__name">On <a href="" title="Yorum Yaptığı Konu Başlığı">Yorum Yaptığı Konu Başlığı</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-newsletter widget">
                                    <h4 class="widget-newsletter__title">Haberler</h4>
                                    <div class="widget-newsletter__text">
                                        Son eklenen ürünlerimizden ve blog yazılarımızdan haberdar olmak için lütfen e-mail sistemimize kayıt olun
                                    </div>
                                    <form class="widget-newsletter__form" action="">
                                        <label for="widget-newsletter-email" class="sr-only">Email Adresiniz...</label>
                                        <input id="widget-newsletter-email" type="text" class="form-control" placeholder="Email Adresiniz...">
                                        <button type="submit" class="btn btn-primary mt-3">Kayıt Ol</button>
                                    </form>
                                </div>
                            </div>
                            <div class="block-sidebar__item">
                                <div class="widget-tags widget">
                                    <h4 class="widget__title">Etiketler</h4>
                                    <div class="tags tags--lg">
                                        <div class="tags__list">
                                            <a href="">Promotion</a>
                                            <a href="">Cutting Discs</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="block">
                            <div class="posts-view">
                                <div class="posts-view__list posts-list posts-list--layout--grid2">
                                    <div class="posts-list__body">
                                        <div class="posts-list__item">
                                            <div class="post-card post-card--layout--grid post-card--size--nl">
                                                <div class="post-card__image">
                                                    <a href="">
                                                        <img src="images/posts/post-1.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-card__info">
                                                    <div class="post-card__date">Kategori • October 19, 2019</div>
                                                    <div class="post-card__name"><a href="">Başlık</a></div>
                                                    <div class="post-card__content">Az bişi önsöz...</div>
                                                    <div class="post-card__read-more"><a href="" class="btn btn-secondary btn-sm">Devamını Oku</a></div>
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
        </div>
        <!-- site__body / end -->
    </div>
    <!-- site / end -->
@endsection
