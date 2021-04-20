<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function all_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Tüm Siparişler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function preparing_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Hazırlanacaklar";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 1)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function waiting_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Ödeme Bekleyenler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 2)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function send_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Gönderilecekler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 3)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function shipped_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Kargoya Verilenler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 4)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }

    }

    public function completed_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Tamamlanmış Siparişler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 5)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function cancelled_orders(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "İptal Edilenler";
            $orders = DB::table('order')
                ->where('order.ref_orderstatus', '=', 6)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->OrderBy('orderdate', 'DESC')
                ->get();
            return view('yonetim.orders', compact('pagetitle', 'orders'));
        }
    }

    public function nextstep(){
        if(Auth::guard('yonetim')->check()) {
            $id = request('siparisid');
            if ($id != null) {
                $order = Order::Where('orderno', $id)->First();
                // Sipariş Hazırlanacaklardaysa Gönderileceklere Gönder
                if ($order->ref_orderstatus == 1) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 3]);
                    Toastr::success('Sipariş Gönderilecekler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_send');
                }
                // Sipariş Ödeme Bekleyenlerdeyse Hazırlanacaklara Gönder
                if ($order->ref_orderstatus == 2) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 1]);
                    Toastr::success('Sipariş Hazırlanacaklar Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_preparing');
                }
                // Sipariş Gönderileceklerdeyse Kargoya Verilenlere Gönder
                if ($order->ref_orderstatus == 3) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 4]);
                    Toastr::success('Sipariş Kargoya Verilenler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_shipped');
                }
                // Sipariş Kargoya Verilenlerdeyse Tamamlanmışlara Gönder
                if ($order->ref_orderstatus == 4) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 5]);
                    Toastr::success('Sipariş Tamamlanmışlar Siparişler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_completed');
                }
            } else {
                return redirect()->route('yonetim.home');
            }
        }
    }

    public function previousstep(){
        if(Auth::guard('yonetim')->check()) {
            $id = request('siparisid');
            if ($id != null) {
                $order = Order::Where('orderno', $id)->First();
                // Sipariş Gönderileceklerdeyse Hazırlanacaklar Listesine Ekle
                if ($order->ref_orderstatus == 3) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 1]);
                    Toastr::success('Sipariş Hazırlanacaklar Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_preparing');
                }
                // Sipariş Kargoya Verilenlerdeyse Gönderilecekler Listesine Ekle
                if ($order->ref_orderstatus == 4) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 3]);
                    Toastr::success('Sipariş Gönderilecekler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_send');
                }
                // Sipariş Tamamlanmışlardaysa Kargoya Verilenler Listesine Ekle
                if ($order->ref_orderstatus == 5) {
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 4]);
                    Toastr::success('Sipariş Kargoya Verilenler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_shipped');
                }

            } else {
                return redirect()->route('yonetim.home');
            }
        }
    }

    public function orderdetail(){
        if(Auth::guard('yonetim')->check()) {
            $orderno = request('siparisid');
            $order = DB::table('order')
                ->where('orderno', '=', $orderno)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->join('city', 'city.cityid', '=', 'address.ref_city')
                ->join('district', 'district.districtid', '=', 'address.ref_district')
                ->first();
            $basket_items = DB::table('basket_item')
                ->where('ref_basket', '=', $order->ref_basket)
                ->join('product', 'product.id', '=', 'basket_item.ref_product')
                ->get();
            $uruntutari = 0;
            $aratoplam = 0;
            $kdv = 0;
            foreach ($basket_items as $cart) {
                $uruntutari += $cart->itemprice * $cart->quantity;
            }
            $kdv = $uruntutari * $cart->itemtax / 100;
            $aratoplam = $uruntutari - $kdv;
            return view('yonetim.orderdetail', compact('order', 'basket_items', 'uruntutari', 'aratoplam', 'kdv'));
        }
    }

    public function orderprint(){
        if(Auth::guard('yonetim')->check()) {
            $orderno = request('siparisid');
            $order = DB::table('order')
                ->where('orderno', '=', $orderno)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->join('city', 'city.cityid', '=', 'address.ref_city')
                ->join('district', 'district.districtid', '=', 'address.ref_district')
                ->first();
            $basket_items = DB::table('basket_item')
                ->where('ref_basket', '=', $order->ref_basket)
                ->join('product', 'product.id', '=', 'basket_item.ref_product')
                ->get();
            $uruntutari = 0;
            $aratoplam = 0;
            $kdv = 0;
            foreach ($basket_items as $cart) {
                $uruntutari += $cart->itemprice * $cart->quantity;
            }
            $kdv = $uruntutari * $cart->itemtax / 100;
            $aratoplam = $uruntutari - $kdv;
            return view('yonetim.orderprint', compact('order', 'basket_items', 'uruntutari', 'aratoplam', 'kdv'));
        }
    }

    public function orderinvoice(){

    }

    public function ordercancel(){
        if(Auth::guard('yonetim')->check()) {
            $id = request('siparisid');
            if ($id) {
                $order = Order::Where('orderno', $id)->First();
                if ($order != null) {
                    if($order->ref_orderstatus == 6){
                    $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 1]);
                    Toastr::success('Sipariş Tekrar Aktifleştirildi.', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_preparing');    
                    }
                    else{
                        $anan = Order::Where('orderno', $id)
                        ->update(['ref_orderstatus' => 6]);
                    Toastr::success('Sipariş İptal Edilenler Listesine Eklendi', 'İşlem Başarılı');
                    return redirect()->route('yonetim.orders_cancelled');
                    }
                    
                }
            }
        }
    }
}
