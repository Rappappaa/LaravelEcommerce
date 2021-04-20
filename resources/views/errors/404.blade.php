@extends('layouts.master')
@section('title','Aradığınız Sayfa Bulunamadı..')
@section('content')
    <!-- site__body -->
    <div class="site__body">
        <div class="block">
            <div class="container">
                <div class="not-found">
                    <div class="not-found__404">
                        Oops! 404 Hatası
                    </div>
                    <div class="not-found__content">
                        <h1 class="not-found__title">Aradığınız Sayfa Bulunamadı..</h1>
                        <a class="btn btn-secondary btn-sm" href="{{ route('home') }}">Ana Sayfaya dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
