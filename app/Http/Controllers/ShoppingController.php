<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Cargo;
use App\Models\Order;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOTools;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Illuminate\Support\Facades\Bus;

class ShoppingController extends Controller
{

    public function cart(){
        if(auth()->check()){
            $cart = DB::table('basket_item')
                ->join('product','basket_item.ref_product' , '=', 'product.id')
                ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get();
            $uruntutari = 0;
            $aratoplam = 0;
            $kdv = 0;
            foreach($cart as $cart){
                $uruntutari += $cart->itemprice * $cart->quantity;
            }
            $kdv = $uruntutari * 8 / 100;
            $aratoplam = $uruntutari - $kdv;
            $url = url()->current();
            SEOTools::setTitle('GFree - Sepetim');
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');

            return view('cart', compact('uruntutari','aratoplam','kdv'));
        }else{
            return redirect()->route('home');
        }
    }

    public function cart_ekle(){
        if (auth()->check()) {
            $quantity = request('quantity');
            $id = request('id');
            $product = Product::Where('id',request('id'))->First();
            $exist = BasketItem::Where(['ref_user' => auth()->user()->id,'ref_product' => $id, 'ref_basket' => null])->First();
            if($exist == null){
                $basket = BasketItem::create([
                    'ref_basket'   => null,
                    'ref_user'     => auth()->user()->id,
                    'ref_product'  => $id,
                    'quantity'     => $quantity,
                    'itemtax'      => $product->tax,
                    'itemprice'    => $product->price,
                ]);
                $message = $product->weight . "GR " . $product->name . " sepetinize eklendi";
                Toastr::success($message,'Ürün Sepetinize Eklendi');
                return redirect()->route('cart');
            }else{
                $anan = BasketItem::Where('ref_user', auth()->user()->id)
                    ->Where('ref_product', $id)
                    ->Where('ref_basket', null)
                    ->update(['quantity' => $exist->quantity + 1]);
                $message = "Sepetinizdeki " . $product->name . " ürünü " . ($exist->quantity + 1) ." adet olarak güncellendi";
                Toastr::success($message,'Ürün Sepetinize Eklendi');
                return redirect()->route('cart');
            }
        }else{
            Toastr::success('Sepetinize ürün ekleyebilmek için lütfen giriş yapınız','Giriş İşlemi Gerekli');
            return redirect()->route('user.login');
        }
    }

    public function cart_kaldir(){
        if (auth()->check()) {
            $id = request('urunid');
            $product = Product::Find(request('urunid'));
            if($product){
                $exist = BasketItem::Where(['ref_user' => auth()->user()->id,'ref_product' => $id, 'ref_basket' => null])->First();
                if($exist != null){
                    BasketItem::Destroy($exist->id);
                    $message = $product->weight . "GR " . $product->name . " sepetinizden kaldırıldı";
                    Toastr::success($message,'Ürün Sepetinizden Kaldırıldı');
                    return redirect()->route('cart');
                }else{
                    Toastr::error('Ürün Sepetinizden Kaldırılamadı.','Hatalı İşlem');
                    return redirect()->route('cart');
                }
            }
        }else{
            return redirect()->route('user.login');
        }
    }

    public function cart_adet(){
        if (auth()->check()) {
            $id = request('urunid');
            $product = Product::Where('id', $id)->First();
            if($product){
                $exist = BasketItem::Where(['ref_user' => auth()->user()->id, 'ref_product' => $id, 'ref_basket' => null])->First();
                if($exist){
                    $type = request('type');
                    if ($type == "artir") {
                        $anan = BasketItem::Where('ref_user', auth()->user()->id)
                            ->Where('ref_product', $id)
                            ->Where('ref_basket', null)
                            ->update(['quantity' => $exist->quantity + 1]);
                        $message = "Sepetinizdeki " . $product->name . " ürünü " . ($exist->quantity + 1) ." adet olarak güncellendi";
                        Toastr::success($message,'Ürün Adeti Değişti');
                        return redirect()->route('cart');
                    }
                    if ($type == "azalt") {
                        $anan = BasketItem::Where('ref_user', auth()->user()->id)
                            ->Where('ref_product', $id)
                            ->Where('ref_basket', null)
                            ->First();
                        if($anan->quantity > 1){
                            $anan = BasketItem::Where('ref_user', auth()->user()->id)
                                ->Where('ref_product', $id)
                                ->Where('ref_basket', null)
                                ->update(['quantity' => $exist->quantity - 1]);
                            $message = "Sepetinizdeki " . $product->name . " ürünü " . ($exist->quantity - 1) ." adet olarak güncellendi";
                            Toastr::success($message,'Ürün Adeti Değişti');
                            return redirect()->route('cart');
                        }
                        else{
                            BasketItem::Destroy($exist->id);
                            $message = "Sepetinizdeki " . $product->name . " ürünü kaldırıldı.";
                            Toastr::success($message,'Ürün Sepetinizden Kaldırıldı');
                            return redirect()->route('cart');
                        }
                    }
                    return redirect()->route('404');
                }else{
                    return redirect()->route('404');
                }
            }else {
                return redirect()->route('404');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function cart_bosalt(){
        if(auth()->check()){
            $bosalt = BasketItem::Where(['ref_user' => auth()->user()->id,'ref_basket' => null])->delete();
            Toastr::success('Sepetinizdeki ürünler kaldırıldı.','Sepeti Boşalt');
            return redirect()->route('cart');
        }else{
            return redirect()->route('home');
        }
    }

    public function completeorder(){
        if(auth()->check()){
            $check = BasketItem::Where(['ref_user' => auth()->user()->id , 'ref_basket' => null])->First();
            if($check != null){
                $cart = DB::table('basket_item')
                    ->join('product','basket_item.ref_product' , '=', 'product.id')
                    ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => null])->get();
                $uruntutari = 0;
                $aratoplam = 0;
                $kdv = 0;
                foreach($cart as $cart){
                    $uruntutari += $cart->itemprice * $cart->quantity;
                }
                $kdv = $uruntutari * 8 / 100;
                $aratoplam = $uruntutari - $kdv;
                $addresses = Address::Where(['ref_user' => auth()->user()->id , 'active' => true])
                    ->join('city','city.cityid','=','address.ref_city')
                    ->join('district','district.districtid','=','address.ref_district')
                    ->get();
                if(request('adresid')){
                    $address = Address::Where(['id' => request('adresid'),'ref_user' => auth()->user()->id ])->First();
                }else{
                    $address = Address::Where(['ref_user' => auth()->user()->id , 'active' => true])->First();
                }

                $url = url()->current();
                SEOTools::setTitle('GFree - Ödeme Yap');
                SEOTools::setCanonical($url);
                SEOTools::opengraph()->setUrl($url);

                SEOTools::opengraph()->addProperty('type', 'website');
                SEOTools::jsonLd()->addImage('../images/logo.png');

                return view('checkout',compact('aratoplam','uruntutari','kdv','address','addresses'));
            }else {
                return redirect()->route('home');
            }
        }else {
            return redirect()->route('home');
        }
    }

    public function makepayment(){
        if(auth()->check()){
            $check = BasketItem::Where(['ref_user' => auth()->user()->id , 'ref_basket' => null])->First();
            if($check != null){
                $paymenttype = request('checkout_payment_method');
                $adresid = request('adresid');
                if($paymenttype != null && $adresid != null){
                    if($paymenttype == "online"){

                    }
                    if($paymenttype == "bank"){
                        return redirect()->route('ordercompleted')->with( ['paymenttype' => request('checkout_payment_method'), 'adresid' => request('adresid')] );
                    }
                    if($paymenttype == "cod"){
                        return redirect()->route('ordercompleted')->with( ['paymenttype' => request('checkout_payment_method'), 'adresid' => request('adresid')] );
                    }
                }else{
                    Toastr::error('İşlem sırasında bir hata oluştu.Lütfen tekrar deneyiniz.','İşlem Başarısız');
                    return redirect()->route('makepayment');
                }
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function ordercompleted()
    {
        if (auth()->check()) {
            $current_date_time = Carbon::now()->toDateTimeString();
            $check = BasketItem::Where(['ref_user' => auth()->user()->id, 'ref_basket' => null])->First();
            if ($check != null) {
                $paymenttype = session()->get('paymenttype');
                $adresid = session()->get('adresid');

                if ($paymenttype == "online") {
                    $_ref_orderstatus = 1; // hazırlanıyor
                    $_ref_paymentmethod = 3; // kredi kartı
                }
                if ($paymenttype == "bank") {
                    $_ref_orderstatus = 2; // ödeme bekliyor
                    $_ref_paymentmethod = 2; // banka transferi
                }
                if ($paymenttype == "cod") {
                    $_ref_orderstatus = 1; // hazırlanıyor
                    $_ref_paymentmethod = 3; // kapıda nakit
                }

                $bosbasketitemvarmi = BasketItem::Where(['ref_user' => auth()->user()->id, 'ref_basket' => null])->First();

                if ($bosbasketitemvarmi) {
                    $cargo = Cargo::Where('active', true)->First();
                    $basket = Basket::create([
                        'ref_user' => auth()->user()->id,
                    ]);

                    $anan = BasketItem::Where('ref_user', auth()->user()->id)
                        ->Where('ref_basket', null)
                        ->update(['ref_basket' => $basket->id]);

                    $cart = DB::table('basket_item')
                        ->join('product', 'basket_item.ref_product', '=', 'product.id')
                        ->where(['basket_item.ref_user' => auth()->user()->id, 'basket_item.ref_basket' => $basket->id])->get();

                    $uruntutari = 0;
                    $aratoplam = 0;
                    $kdv = 0;
                    foreach ($cart as $cart) {
                        $uruntutari += $cart->itemprice * $cart->quantity;
                    }
                    $kdv = $uruntutari * 8 / 100;
                    $aratoplam = $uruntutari - $kdv;
                    $address = Address::Where(['ref_user' => auth()->user()->id, 'address.id' => $adresid])
                        ->join('city', 'city.cityid', '=', 'address.ref_city')
                        ->join('district', 'district.districtid', '=', 'address.ref_district')
                        ->First();

                    $order = Order::create([
                        'orderno' => auth()->user()->id . $basket->id,
                        'ref_user' => auth()->user()->id,
                        'ref_address' => $adresid,
                        'ref_basket' => $basket->id,
                        'ref_orderstatus' => $_ref_orderstatus,
                        'ref_paymentmethod' => $_ref_paymentmethod,
                        'ref_cargo' => $cargo->id,
                        'totalprice' => $uruntutari,
                        'orderdate' => $current_date_time
                    ]);
                    $order = Order::Where(['ref_user' => auth()->user()->id, 'orderno' => $order->orderno])
                        ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                        ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')->First();

                    $url = url()->current();
                    SEOTools::setTitle('GFree - Sipariş Tamamlandı!');
                    SEOTools::setCanonical($url);
                    SEOTools::opengraph()->setUrl($url);

                    SEOTools::opengraph()->addProperty('type', 'website');
                    SEOTools::jsonLd()->addImage('../images/logo.png');

                    return view('ordercompleted', compact('order', 'cart', 'uruntutari', 'aratoplam', 'kdv', 'address', 'basket', 'current_date_time'));
                } else {
                    return redirect()->route('home');
                }
            }
        }
    }

}
