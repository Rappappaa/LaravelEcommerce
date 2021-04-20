@extends('layouts.master')
@section('content')
    <!-- site__body -->
    <div class="site__body">
        <div class="block-map block">
            <div class="block-map__body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12128.30328417448!2d34.953486!3d40.539914!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x521683e21e5d510e!2zQVJaVSBLVVJVWUVNxLDFniAoR0ZSRUUgR0xVVEVOU8SwWiBLVVJVWUVNxLDFnik!5e0!3m2!1sen!2str!4v1603378954179!5m2!1sen!2str" frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe>
            </div>
        </div>
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
                                <a href="{{ route('contact') }}">İletişim</a>
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>İletişim</h1>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="card mb-0">
                    <div class="card-body contact-us">
                        <div class="contact-us__container">
                            <div class="row">
                                <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                                    <h4 class="contact-us__header card-title">Adresimiz</h4>
                                    <div class="contact-us__address">
                                        <p>
                                            Gülabibey Mahallesi<br>
                                            Cemilbey Caddesi No:69/A Merkez/ÇORUM<br><br>
                                            info@glutensizkuruyemis.com<br><br>
                                            +90 530 971 19 00
                                        </p>
                                        <!--
                                        <p>
                                            <strong>Buraya Bişey olabilir</strong><br>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit suscipit mi, non
                                            tempor nulla finibus eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        -->
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h4 class="contact-us__header card-title">Mesajınızı Bırakın</h4>
                                    <form action="{{ route('contact_send') }}" METHOD="POST">
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="form-name">Adınız ve Soyadınız</label>
                                                <input type="text" id="namesurname" name="namesurname" class="form-control" placeholder="Adınız ve Soyadınız" required
                                                       value="@php
                                                           if(auth()->check()){
                                                           echo auth()->user()->name;
                                                           echo " ";
                                                           echo auth()->user()->surname;
                                                       }
                                                       @endphp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="form-email">Email adresiniz</label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Email adresiniz" required
                                                       value="@php
                                                           if(auth()->check()){
               echo auth()->user()->email;
           }
                                                       @endphp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-subject">Konu</label>
                                            <input type="text" id="konu" name="konu" class="form-control" placeholder="Konu" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-message">Mesajınız</label>
                                            <textarea id="mesaj" name="mesaj" class="form-control" rows="4" placeholder="Mesajınız" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gönder</button>
                                    </form>
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
