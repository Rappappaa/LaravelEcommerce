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
                            <li class="breadcrumb-item active" aria-current="page">Kayıt Ol</li>
                        </ol>
                    </nav>
                </div>
                <div class="page-header__title">
                    <h1>Kayıt Ol</h1>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column">
                        <div class="card flex-grow-1 mb-0">
                            <div class="card-body">
                                <h3 class="card-title">Kayıt Ol</h3>
                                <div class="form-group">
                                    <label>Zaten üyeliğiniz varsa <a href="{{ route('user.login') }}">buraya tıklayarak</a> üye girişi yapabilirsiniz.</label>
                                </div>
                                <form class="form-horizontal" role="form" action="{{ route('user.register') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Adınız</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Adınız" required autofocus value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Soyadınız</label>
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Soyadınız" required value="{{ old('surname') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Telefon Numaranız <span class="text-muted">(10 Haneli olacak şekilde)</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon numaranız" required value="{{ old('phone') }}" maxlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label>Email adresiniz</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email adresiniz" required value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Şifreniz</label>
                                        <input type="password" class="form-control" id="password" name="password"  placeholder="Şifreniz" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Şifrenizin Tekrarı</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Şifrenizin Tekrarı" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Kayıt Ol</button>
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
