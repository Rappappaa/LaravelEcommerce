<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@index')->name("home");
Route::get('/glutensiz-urunler/{slug}','ProductController@index')->name("product");
Route::post('/yorum-yap','ProductController@make_comment')->name("make_comment");
Route::get('/glutensiz-magaza','ShopController@shop')->name("shop");
Route::get('/glutensiz-magaza/{slug}','ShopController@maincategory')->name("shop.maincategory");
Route::get('/404','NotFoundController@index')->name("404Page");

Route::group(['middleware' => 'auth'], function () {

    /*
    |--------------------------------------------------------------------------
    | Giriş Yapmış Kullanıcı Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'kullanici-islemleri'], function () {
            Route::post('/oturumukapat', 'UserController@cikisyap')->name('user.logout');
            Route::get('/genel-bakis', 'UserController@genelbakis')->name('user.dashboard');
            Route::get('/profilim', 'UserController@profil')->name('user.profile');
            Route::post('/profilim', 'UserController@edit_profil')->name('user.edit_profile');
            Route::get('/siparislerim', 'UserController@siparisler')->name('user.orders');
            Route::post('/siparis-detayi', 'UserController@siparis_detay')->name('user.order_detail');
            Route::get('/adreslerim', 'UserController@adresler')->name('user.address');
            Route::post('/adreslerim', 'UserController@adresler')->name('user.address_edit');
            Route::post('/adres-ekle', 'UserController@adres_ekle')->name('user.add_address');
            //Route::get('/adres-duzenle', 'UserController@adres_duzenle')->name('user.edit_address');
            Route::post('/adres-duzenle', 'UserController@adres_duzenle')->name('user.edit_address');
            Route::post('/adres-aktif', 'UserController@adres_aktif')->name('user.active_address');
            Route::post('/adres-sil', 'UserController@adres_sil')->name('user.delete_address');
            Route::get('/sifre-degistirme', 'UserController@sifre_degistir')->name('user.change_password');
            Route::post('/sifre-degistirme', 'UserController@sifre_degistir_action')->name('user.change_password_action');
        });

    /*
    |--------------------------------------------------------------------------
    | Sepet Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/sepet', 'ShoppingController@cart')->name('cart');
    Route::post('/sepet-ekle', 'ShoppingController@cart_ekle')->name('cart_ekle');
    Route::post('/sepet-kaldir', 'ShoppingController@cart_kaldir')->name('cart_kaldir');
    Route::post('/sepet-adet', 'ShoppingController@cart_adet')->name('cart_adet');
    Route::post('/sepet-bosalt', 'ShoppingController@cart_bosalt')->name('cart_bosalt');
    Route::get('/siparisi-tamamla', 'ShoppingController@completeorder')->name('completeorder');
    Route::post('/siparisi-tamamla', 'ShoppingController@completeorder');
    Route::post('/odeme-yap', 'ShoppingController@makepayment')->name('makepayment');
    Route::get('/siparis-tamamlandi', 'ShoppingController@ordercompleted')->name('ordercompleted');

});

Route::group(['middleware' => 'guest'], function () {

    /*
    |--------------------------------------------------------------------------
    | Giriş Yapmamış Kullanıcı Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'kullanici-islemleri'], function () {
        Route::get('/oturumac', 'UserController@oturumac_form')->name('user.login');
        Route::post('/oturumac', 'UserController@oturumac');
        Route::get('/kaydol', 'UserController@kayit_form')->name('user.register');
        Route::post('/kaydol', 'UserController@uye_kayit');
        Route::get('/aktivasyon/{anahtar}', 'UserController@activation')->name('user.activation');
        Route::get('/sifremi-unuttum', 'UserController@forgot_password')->name('user.forgot_password');
    });

});

Route::group(['prefix' => 'blog'], function () {
    /*
    |--------------------------------------------------------------------------
    | Genel Blog Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/', 'BlogController@blogmain')->name('blog');
    Route::get('/{slug}', 'BlogController@blog_category')->name('blog.category');
});


Route::group(['prefix' => 'kurumsal'], function () {
    /*
    |--------------------------------------------------------------------------
    | Kurumsal Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/hakkimizda', 'InformationController@aboutus')->name('aboutus');
    Route::get('/mesafeli-satis-sozlesmesi', 'InformationController@mss')->name('mss');
    Route::get('/on-bilgilendirme-formu', 'InformationController@obf')->name('obf');
    Route::get('/gizlilik-politikamiz', 'InformationController@privacy')->name('privacy');
    Route::get('/satis-noktalarimiz', 'InformationController@salepoints')->name('salepoints');
    Route::get('/kargo-ve-teslimat', 'InformationController@delivery')->name('delivery');
    Route::get('/site-haritasi', 'InformationController@sitemap')->name('sitemap');

    Route::get('/is-ortakligi', 'CorporateController@partnership')->name('partnership');
    Route::get('/sponsorluk', 'CorporateController@sponsorship')->name('sponsorship');
    Route::get('/bayilik', 'CorporateController@distributor')->name('distributor');
    Route::get('/iletisim', 'ContactController@contact')->name('contact');
    Route::post('/iletisim', 'ContactController@send')->name('contact_send');
});



Route::get('/test/mail', function () {
    //$user = User::find(4);
    //return new App\Mail\UserRegistrationMail($user);
    return view('mail');
});

Route::group(['prefix' => 'yonetim','namespace' => 'Yonetim'], function(){
    Route::redirect('/','/yonetim/giris-yap');
    Route::get('/giris-yap','UserController@login_form')->name('yonetim.login_form');
    Route::post('/giris-yap','UserController@login_action')->name('yonetim.login_action');
    Route::post('/cikis-yap','UserController@logout_action')->name('yonetim.logout_action');

    Route::group(['middleware'=> 'yonetim'], function(){
        Route::get('/','HomeController@index')->name('yonetim.home');
        Route::get('/siparisler/tum-siparisler','OrdersController@all_orders')->name('yonetim.orders_all');
        Route::get('/siparisler/hazirlanacak-siparisler','OrdersController@preparing_orders')->name('yonetim.orders_preparing');
        Route::get('/siparisler/odeme-bekleyen-siparisler','OrdersController@waiting_orders')->name('yonetim.orders_waiting');
        Route::get('/siparisler/gonderilecek-siparisler','OrdersController@send_orders')->name('yonetim.orders_send');
        Route::get('/siparisler/kargolanmis-siparisler','OrdersController@shipped_orders')->name('yonetim.orders_shipped');
        Route::get('/siparisler/tamamlanmis-siparisler','OrdersController@completed_orders')->name('yonetim.orders_completed');
        Route::get('/siparisler/iptal-edilen-siparisler','OrdersController@cancelled_orders')->name('yonetim.orders_cancelled');

        Route::post('/siparis-detay','OrdersController@orderdetail')->name('yonetim.order_detail');
        Route::post('/siparisi-yazdir','OrdersController@orderprint')->name('yonetim.order_print');
        Route::post('/siparis-faturasi','OrdersController@orderinvoice')->name('yonetim.order_invoice');
        Route::post('/siparis-islemleri-sonraki-adim','OrdersController@nextstep')->name('yonetim.next_step');
        Route::post('/siparis-islemleri-onceki-adim','OrdersController@previousstep')->name('yonetim.previous_step');
        Route::post('/siparis-iptal','OrdersController@ordercancel')->name('yonetim.order_cancel');

        Route::get('/istatistikler','StatisticsController@index')->name('yonetim.statistics');
        Route::post('/istatistikler','StatisticsController@index')->name('yonetim.statistic_filter');
        Route::get('/istatistikler/kredi-karti-satislari','StatisticsController@creditcart')->name('yonetim.statistics_credit_cart');
        Route::post('/istatistikler/kredi-karti-satislari','StatisticsController@creditcart')->name('yonetim.statistics_credit_cart_filter');
        Route::get('/istatistikler/banka-transferi-satislari','StatisticsController@transfer')->name('yonetim.statistics_transfer');
        Route::post('/istatistikler/banka-transferi-satislari','StatisticsController@transfer')->name('yonetim.statistics_transfer_filter');
        Route::get('/istatistikler/nakit-satislar','StatisticsController@cash')->name('yonetim.statistics_cash');
        Route::post('/istatistikler/nakit-satislar','StatisticsController@cash')->name('yonetim.statistics_cash_filter');
        Route::get('/istatistikler/iptal-edilen-satislar','StatisticsController@cancelled')->name('yonetim.statistics_cancelled');
        Route::post('/istatistikler/iptal-edilen-satislar','StatisticsController@cancelled')->name('yonetim.statistics_cancelled_filter');

        Route::get('/tum-kullanicilar','UserController@index')->name('yonetim.users');
        Route::get('/aktif-kullanicilar','UserController@aktif_kullanicilar')->name('yonetim.users_active');
        Route::post('/aktif-kullanicilar','UserController@aktif_kullanicilar')->name('yonetim.users_active_action');
        Route::get('/pasif-kullanicilar','UserController@pasif_kullanicilar')->name('yonetim.users_passive');
        Route::post('/pasif-kullanicilar','UserController@pasif_kullanicilar')->name('yonetim.users_passive_action');

        Route::get('/tum-urunler','ProductController@index')->name('yonetim.products');
        Route::get('/aktif-urunler','ProductController@aktif_urunler')->name('yonetim.products_active');
        Route::post('/aktif-urunler','ProductController@aktif_urunler')->name('yonetim.products_active_action');
        Route::get('/pasif-urunler','ProductController@pasif_urunler')->name('yonetim.products_passive');
        Route::post('/pasif-urunler','ProductController@pasif_urunler')->name('yonetim.products_passive_action');

        Route::post('/urun-duzenle','ProductController@edit_product')->name('yonetim.products_edit');
        Route::get('/yorumlar','VoteController@index')->name('yonetim.all_votes');
        Route::get('/aktif-yorumlar','VoteController@active_votes')->name('yonetim.active_votes');
        Route::post('/aktif-yorumlar','VoteController@active_votes_action')->name('yonetim.active_votes_action');
        Route::get('/pasif-yorumlar','VoteController@passive_votes')->name('yonetim.passive_votes');
        Route::post('/pasif-yorumlar','VoteController@passive_votes_action')->name('yonetim.passive_votes_action');

        Route::get('/cikti','ExportController@index')->name('export.cargo');
    });
});


