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
                                Kullanıcı İşlemleri
                                <svg class="breadcrumb-arrow" width="6px" height="9px">
                                    <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                                </svg>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Giriş Yap</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Giriş Yap</h1>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column">
                        <div class="card flex-grow-1 mb-md-0">
                            <div class="card-body">
                                <h3 class="card-title">Giriş Yap</h3>
                                <div class="form-group">
                                        <label>Henüz üye olmadıysanız <a href="{{ route('user.register') }}">buraya tıklayarak</a> üye olabilirsiniz.</label>
                                    </div>
                                <form class="form-horizontal" role="form"  action="{{ route('user.login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Email adresiniz</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email adresiniz" required autofocus value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Şifreniz</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Şifreniz" required autofocus>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Giriş Yap</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site__body / end -->
@endsection
