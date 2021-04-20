<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationMail;
use App\Models\Address;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function kayit_form(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Kullanıcı Kayıt Formu');
        SEOTools::setDescription('Websitemizden alışveriş yapabilmeniz için üye olmanız gerekmektedir.');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        if(!auth()->check()){
            return view('layouts.user.account-register');
        }else{
            return redirect()->route('home');
        }
    }

    public function uye_kayit(){
        if(!auth()->check()) {
            $exist = User::Where('email', request('email'))->First();
            if ($exist == null) {
                if(request('password') != request('password_confirmation')){
                    Toastr::error('Şifreniz ve Tekrarı uyuşmuyor.','Kayıt Başarısız');
                    return redirect()->route('user.register');
                }
                $user = User::create([
                    'name' => request('name'),
                    'surname' => request('surname'),
                    'phone' => request('phone'),
                    'email' => request('email'),
                    'password' => Hash::make(request('password')),
                    'ref_role' => 1,
                    'active' => 1
                ]);
                Mail::to(request('email'))->send(new UserRegistrationMail($user));
                auth()->login($user);
                Toastr::success('Kaydınız başarıyla tamamlanmıştır.','Kayıt Başarılı');
                return redirect()->route('home');
            }else {
                Toastr::error('Bu email ile daha önce bir kayıt oluşturulmuş. Lütfen farklı bir email adresi deneyiniz.','Kayıt Başarısız');
                return redirect()->route('user.register');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function oturumac_form(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Kullanıcı Girişi');
        SEOTools::setDescription('Kullanıcı girişi yaparak sitemize tam erişim sağlayın.');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        if(!auth()->check()) {
            return view('layouts.user.account-login');
        }else{
            return redirect()->route('home');
        }
    }

    public function oturumac(){
        if(!auth()->check()) {
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => request('email'),
                'password' => request('password'),
                'active' => 1
            ];

            if (auth()->attempt($credentials)) {
                request()->session()->regenerate();
                Toastr::success('Giriş İşleminiz başarıyla yapılmıştır.','Giriş Yapıldı');
                return redirect()->intended('/');
            } else {
                Toastr::error('Giriş İşleminiz başarısız olmuştur.','Giriş Yapılamadı');
                return redirect()->route('user.login');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function cikisyap(){
        if(auth()->check()) {
            auth()->logout();
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }

    public function genelbakis(){

        if(auth()->check()) {
            $adres = Address::Where(['ref_user' => auth()->user()->id, 'default' => true])
                ->join('city', 'city.cityid', '=', 'address.ref_city')
                ->join('district', 'district.districtid', '=', 'address.ref_district')
                ->First();
            if($adres == null){
                $adres = Address::Where(['ref_user' => auth()->user()->id, 'active' => true])
                    ->join('city', 'city.cityid', '=', 'address.ref_city')
                    ->join('district', 'district.districtid', '=', 'address.ref_district')
                    ->First();
            }
            $orders = Order::Where('ref_user', auth()->user()->id)
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->OrderBy('orderno', 'desc')
                ->get();
            $baskets = Basket::Where('ref_user', auth()->user()->id)->get();
            $basketItems = BasketItem::Where('ref_user', auth()->user()->id)->get();
            $orderstatus = OrderStatus::All();

            $url = url()->current();
            SEOTools::setTitle('GFree - Genel Bakış');
            SEOTools::setDescription('Kullanıcı hesabınıza genel bakış yapın.');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');

            return view('layouts.user.account-dashboard', compact('adres', 'orders', 'baskets', 'basketItems', 'orderstatus'));
        }else{
            return redirect()->route('home');
        }
    }

    public function profil(){
        if(auth()->check()) {
            $user = User::Find(auth()->user()->id);
            $url = url()->current();
            SEOTools::setTitle('GFree - Profilim');
            SEOTools::setDescription('Kullanıcı profilinizi inceleyebilirsiniz.');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');
            return view('layouts.user.account-profile', compact('user'));
        }else{
            return redirect()->route('home');
        }
    }

    public function edit_profil(){
        if(auth()->check()) {
                User::Where('id', auth()->user()->id)
                    ->update([
                        'name' => request('name'),
                        'surname' => request('surname'),
                        'phone' => request('phone'),
                        'email' => request('email')
                    ]);
                $user = User::Find(auth()->user()->id);
                Toastr::success('Profiliniz başarıyla güncellenmiştir.','Kayıt Başarılı');
                return view('layouts.user.account-profile', compact('user'));
        }else{
            return redirect()->route('home');
        }
    }

    public function siparisler(){

        if(auth()->check()) {
            $orders = Order::Where('ref_user', auth()->user()->id)
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->OrderBy('orderno', 'desc')
                ->get();
            $url = url()->current();
            SEOTools::setTitle('GFree - Siparişlerim ');
            SEOTools::setDescription('Tüm siparişlerinizi buradan kontrol edebilirsiniz.');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');
            return view('layouts.user.account-orders', compact('orders'));
        }else{
            return redirect()->route('home');
        }
    }

    public function siparis_detay(){

        if(auth()->check()) {
            if(request('orderid') != null){
                $orders = Order::Where(['ref_user' => auth()->user()->id, 'orderno' => request('orderid')])
                    ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                    ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')->First();
                if($orders != null){
                    $basket = Basket::Where(['ref_user' => auth()->user()->id, 'id' => $orders->ref_basket])->First();
                    $basketItems = BasketItem::Where(['ref_user' => auth()->user()->id, 'ref_basket' => $basket->id])->get();

                    $adres = Address::Where(['address.id' => $orders->ref_address, 'ref_user' => auth()->user()->id])
                        ->join('city', 'city.cityid', '=', 'address.ref_city')
                        ->join('district', 'district.districtid', '=', 'address.ref_district')
                        ->First();

                    $url = url()->current();
                    SEOTools::setTitle('GFree - Siparişlerim ' . '#' . $orders->orderno);
                    SEOTools::setDescription('Tüm siparişlerinizi buradan kontrol edebilirsiniz.');
                    SEOTools::setCanonical($url);
                    SEOTools::opengraph()->setUrl($url);

                    SEOTools::opengraph()->addProperty('type', 'website');
                    SEOTools::jsonLd()->addImage('../images/logo.png');

                    return view('layouts.user.account-orderdetail', compact('orders', 'basket', 'basketItems', 'adres'));
                }else{
                    return redirect()->route('404');
                }
            }else{
                return redirect()->route('404');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function adresler(){
        if(auth()->check()) {
            if(request('mode') == "aktifler" || request('mode') == null){
                $adres = Address::Where(['ref_user' => auth()->user()->id, 'active' => true])
                    ->join('city', 'city.cityid', '=', 'address.ref_city')
                    ->join('district', 'district.districtid', '=', 'address.ref_district')
                    ->get();
                $statu = "aktifler";

                $url = url()->current();
                SEOTools::setTitle('GFree - Aktif Adreslerim');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                return view('layouts.user.account-addresses', compact('adres','statu'));
            }
            if(request('mode') == "pasifler"){
                $adres = Address::Where(['ref_user' => auth()->user()->id, 'active' => false])
                    ->join('city', 'city.cityid', '=', 'address.ref_city')
                    ->join('district', 'district.districtid', '=', 'address.ref_district')
                    ->get();
                $statu = "pasifler";

                $url = url()->current();
                SEOTools::setTitle('GFree - Pasif Adreslerim');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                return view('layouts.user.account-addresses', compact('adres','statu'));
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function adres_ekle(){
        if(auth()->check()) {

            $url = url()->current();
            SEOTools::setTitle('GFree - Adres Ekleme');
            SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');


            $cities = City::All();
            $title = "Adres Ekle";
            $adres = null;
            $gidecegiyer = request('gidecegiyer');
            return view('layouts.user.account-edit-address', compact('cities', 'title', 'adres','gidecegiyer'));
        }else{
            return redirect()->route('home');
        }
    }

    public function adres_duzenle(){
        if(auth()->check()) {
            $mode = request('mode');
            $id = request('adresid');
            $default = request('varsayilan');
            $defaultyap = null;

            if ($mode == "new") {
                $cities = City::All();
                $title = "Adres Düzenle";
                $adres = null;
                $districts = null;
                $gidecegiyer = request('gidecegiyer');

                $url = url()->current();
                SEOTools::setTitle('GFree - Adres Düzenleme');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                return view('layouts.user.account-edit-address', compact('cities', 'title', 'adres', 'districts','gidecegiyer'));
            }
            if ($mode == "view") {
                $cities = City::All();
                $title = "Adres Düzenle";
                $adres = Address::Find($id);
                $districts = District::Where('ref_city', $adres->ref_city)->get();
                $gidecegiyer = request('gidecegiyer');

                $url = url()->current();
                SEOTools::setTitle('GFree - Adres Ekleme');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                return view('layouts.user.account-edit-address', compact('cities', 'title', 'adres', 'districts','gidecegiyer'));
            }
            if ($mode == "record") {
                if ($default == "on") {
                    $olds = Address::Where(['ref_user' => auth()->user()->id, 'active' => true])->get();
                    if ($olds != null) {
                        foreach ($olds as $old) {
                            Address::Where('id', $old->id)->update(['default' => false]);
                        }
                    }
                    $defaultyap = true;
                }
                if ($default == null) $defaultyap = false;

                $anan = Address::create([
                    'ref_user' => auth()->user()->id,
                    'receiver_name' => request('receiver_name'),
                    'receiver_surname' => request('receiver_surname'),
                    'receiver_phone' => request('receiver_phone'),
                    'address' => request('address'),
                    'ref_city' => request('city_menu'),
                    'ref_district' => request('district_menu'),
                    'quarter' => request('quarter'),
                    'default' => $defaultyap,
                    'active' => true
                ]);
                Toastr::success('Adresiniz başarıyla kaydedilmiştir.','Kayıt Başarılı');

                $url = url()->current();
                SEOTools::setTitle('GFree - Adres Ekleme');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                if(request('gidecegiyer')){
                    return redirect()->route(request('gidecegiyer'));
                }else{
                    return redirect()->route('user.address');
                }

            }
            if ($mode == "update") {
                if ($default == "on") {
                    $olds = Address::Where(['ref_user' => auth()->user()->id, 'active' => true])->get();
                    if ($olds != null) {
                        foreach ($olds as $old) {
                            Address::Where('id', $old->id)->update(['default' => false]);
                        }
                    }
                    $defaultyap = true;
                }
                if ($default == null) $defaultyap = false;
                $anan = Address::Where('ref_user', auth()->user()->id)
                    ->Where('id', $id)
                    ->update([
                        'receiver_name' => request('receiver_name'),
                        'receiver_surname' => request('receiver_surname'),
                        'receiver_phone' => request('receiver_phone'),
                        'address' => request('address'),
                        'ref_city' => request('city_menu'),
                        'ref_district' => request('district_menu'),
                        'quarter' => request('quarter'),
                        'default' => $defaultyap,
                        'active' => true
                    ]);
                Toastr::success('Adresiniz başarıyla güncellenmiştir.','Kayıt Başarılı');

                $url = url()->current();
                SEOTools::setTitle('GFree - Adres Ekleme');
                SEOTools::setDescription('Tüm adreslerinizi buradan kontrol edebilirsiniz.');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');
                if(request('gidecegiyer')){
                    return redirect()->route(request('gidecegiyer'));
                }else{
                    return redirect()->route('user.address');
                }
            }

        }else{
            return redirect()->route('home');
        }
    }

    public function adres_aktif(){
        if(auth()->check()){
            $id = request('adresid');
            $anan = Address::Find($id);
            $anan = Address::Where('ref_user', auth()->user()->id)->Where('id', $id)->update(['active' => true]);
            Toastr::success('Adresiniz başarıyla aktifleştirilmiştir.','Kayıt Aktifleştirme');
            return redirect()->route('user.address');
        }else{
            return redirect()->route('home');
        }
    }

    public function adres_sil(){
        if(auth()->check()){
            $id = request('adresid');
            $anan = Address::Find($id);
            $varmi = Order::Where(['ref_user' => auth()->user()->id, 'ref_address' => $anan->id])->First();
            if($varmi == null){
                $baban = Address::destroy($anan->id);
                Toastr::success('Adresiniz başarıyla silinmiştir.','Silme Başarılı');
                return redirect()->route('user.address');
            }else{
                $anan = Address::Where('ref_user', auth()->user()->id)->Where('id', $id)->update(['active' => false, 'default' => false]);
                Toastr::success('Adresiniz başarıyla silinmiştir.','Silme Başarılı');
                return redirect()->route('user.address');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function sifre_degistir(){
        if(auth()->check()) {

            $url = url()->current();
            SEOTools::setTitle('GFree - Şifre Değiştirme');
            SEOTools::setDescription('Şifrenizi buradan kontrol edebilirsiniz.');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');


            return view('layouts.user.account-change-password');
        }else{
            return redirect()->route('home');
        }
    }

    public function sifre_degistir_action(){
        if(auth()->check()){
            $old_password = request('password-current');
            $new_password = request('password-new');
            $new_password_confirm = request('password-confirm');
            if(Hash::check($old_password,auth()->user()->password)){
                if($new_password == $new_password_confirm){
                    User::Where('id', auth()->user()->id)
                        ->update(['password' => Hash::make($new_password)]);
                    Toastr::success('Lütfen bir sonraki girişinizde yeni şifrenizi kullanınız.','Şifre Güncelleme Başarılı');
                    return redirect()->route('user.dashboard');
                }else{
                    Toastr::error('Yeni şifreniz doğrulama alanıyla eşleşmiyor.','Şifre Güncelleme Başarısız');
                    return redirect()->route('user.change_password');
                }
            }else{
                Toastr::error('Lütfen eski şifreniz ile tekrar deneyiniz.','Şifre Güncelleme Başarısız');
                return redirect()->route('user.change_password');
            }
        }else{
            return redirect()->route('home');
        }
    }

}
