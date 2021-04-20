<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $ay = request('ay');
            $yil = request('yil');
            $today = "";
            $gunler = "";
            $gun = "";
            if ($ay == null) {
                $today = Carbon::now();
                $ay = $today->month;
                $yil = $today->year;
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            } else {
                $today = Carbon::now()->year($yil)->month($ay);
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            }

            $aylar = [1 => "Ocak", 2 => "Şubat", 3 => "Mart", 4 => "Nisan", 5 => "Mayıs", 6 => "Haziran", 7 => "Temmuz", 8 => "Ağustos", 9 => "Eylül", 10 => "Ekim", 11 => "Kasım", 12 => "Aralık"];


            $pagetitle = "Tüm Satışlar";
            // Toplam Ciro
            $toplamciro = DB::table('order')->where('order.ref_orderstatus', '!=', 6)->Sum('totalprice');
            $toplamciroadet = DB::table('order')->where('order.ref_orderstatus', '!=', 6)->Count('orderno');

            $toplamkredikarticirosu = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Sum('totalprice');

            $toplamkredikarticirosuadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Count('orderno');

            $toplambankacirosu = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Sum('totalprice');

            $toplambankacirosuadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Count('orderno');

            $toplamnakitciro = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Sum('totalprice');

            $toplamnakitciroadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Count('orderno');

            // Aylık Ciro
            $ayliktoplam = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->Sum('totalprice');

            $ayliktoplamadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->Count('orderno');

            $aylikkredikarti = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Sum('totalprice');

            $aylikkredikartiadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Count('orderno');

            $aylikbankatransferi = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Sum('totalprice');

            $aylikbankatransferiadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Count('orderno');

            $ayliknakit = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Sum('totalprice');

            $ayliknakitadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Count('orderno');

            switch ($ay) {
                case 1:
                    $ay = "Ocak";
                    break;
                case 2:
                    $ay = "Şubat";
                    break;
                case 3:
                    $ay = "Mart";
                    break;
                case 4:
                    $ay = "Nisan";
                    break;
                case 5:
                    $ay = "Mayıs";
                    break;
                case 6:
                    $ay = "Haziran";
                    break;
                case 7:
                    $ay = "Temmuz";
                    break;
                case 8:
                    $ay = "Ağustos";
                    break;
                case 9:
                    $ay = "Eylül";
                    break;
                case 10:
                    $ay = "Ekim";
                    break;
                case 11:
                    $ay = "Kasım";
                    break;
                case 12:
                    $ay = "Aralık";
                    break;
            }

            return view('yonetim.sales',
                compact('pagetitle',
                    'toplamciro', 'toplamkredikarticirosu', 'toplambankacirosu', 'toplamnakitciro',
                    'toplamciroadet', 'toplamkredikarticirosuadet', 'toplambankacirosuadet', 'toplamnakitciroadet',
                    'aylikkredikarti', 'aylikbankatransferi', 'ayliknakit', 'ayliktoplam', 'aylar', 'ay', 'yil', 'gunler',
                    'aylikkredikartiadet', 'aylikbankatransferiadet', 'ayliknakitadet', 'ayliktoplamadet', 'aylar', 'ay', 'gunler',
                ));
        }
    }

    public function creditcart(){
        if(Auth::guard('yonetim')->check()) {
            $ay = request('ay');
            $yil = request('yil');
            $today = "";
            $gunler = "";
            $gun = "";
            $siparisler = "";
            if ($ay == null) {
                $today = Carbon::now();
                $ay = $today->month;
                $yil = $today->year;
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            } else {
                $today = Carbon::now()->year($yil)->month($ay);
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            }

            $aylar = [1 => "Ocak", 2 => "Şubat", 3 => "Mart", 4 => "Nisan", 5 => "Mayıs", 6 => "Haziran", 7 => "Temmuz", 8 => "Ağustos", 9 => "Eylül", 10 => "Ekim", 11 => "Kasım", 12 => "Aralık"];


            $pagetitle = "Kredi Kartı Satışları";
            // Toplam Ciro
            $toplamciro = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Sum('totalprice');

            $toplamciroadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Count('orderno');

            // Aylık Ciro
            $ayliktoplam = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Sum('totalprice');

            $ayliktoplamadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 1)
                ->Count('orderno');

            $siparisler = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->where('order.ref_paymentmethod', '=', 1)
                ->get();

            switch ($ay) {
                case 1:
                    $ay = "Ocak";
                    break;
                case 2:
                    $ay = "Şubat";
                    break;
                case 3:
                    $ay = "Mart";
                    break;
                case 4:
                    $ay = "Nisan";
                    break;
                case 5:
                    $ay = "Mayıs";
                    break;
                case 6:
                    $ay = "Haziran";
                    break;
                case 7:
                    $ay = "Temmuz";
                    break;
                case 8:
                    $ay = "Ağustos";
                    break;
                case 9:
                    $ay = "Eylül";
                    break;
                case 10:
                    $ay = "Ekim";
                    break;
                case 11:
                    $ay = "Kasım";
                    break;
                case 12:
                    $ay = "Aralık";
                    break;
            }

            return view('yonetim.salestype',
                compact('pagetitle',
                    'toplamciro', 'toplamciroadet', 'ayliktoplam', 'ayliktoplamadet',
                    'aylar', 'ay', 'yil', 'gunler', 'siparisler'));
        }
    }

    public function transfer(){
        if(Auth::guard('yonetim')->check()) {
            $ay = request('ay');
            $yil = request('yil');
            $today = "";
            $gunler = "";
            $gun = "";
            $siparisler = "";
            if ($ay == null) {
                $today = Carbon::now();
                $ay = $today->month;
                $yil = $today->year;
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            } else {
                $today = Carbon::now()->year($yil)->month($ay);
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            }

            $aylar = [1 => "Ocak", 2 => "Şubat", 3 => "Mart", 4 => "Nisan", 5 => "Mayıs", 6 => "Haziran", 7 => "Temmuz", 8 => "Ağustos", 9 => "Eylül", 10 => "Ekim", 11 => "Kasım", 12 => "Aralık"];


            $pagetitle = "Havale/Eft Satışları";
            // Toplam Ciro
            $toplamciro = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Sum('totalprice');

            $toplamciroadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Count('orderno');

            // Aylık Ciro
            $ayliktoplam = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Sum('totalprice');

            $ayliktoplamadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 2)
                ->Count('orderno');

            $siparisler = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->where('order.ref_paymentmethod', '=', 2)
                ->get();

            switch ($ay) {
                case 1:
                    $ay = "Ocak";
                    break;
                case 2:
                    $ay = "Şubat";
                    break;
                case 3:
                    $ay = "Mart";
                    break;
                case 4:
                    $ay = "Nisan";
                    break;
                case 5:
                    $ay = "Mayıs";
                    break;
                case 6:
                    $ay = "Haziran";
                    break;
                case 7:
                    $ay = "Temmuz";
                    break;
                case 8:
                    $ay = "Ağustos";
                    break;
                case 9:
                    $ay = "Eylül";
                    break;
                case 10:
                    $ay = "Ekim";
                    break;
                case 11:
                    $ay = "Kasım";
                    break;
                case 12:
                    $ay = "Aralık";
                    break;
            }

            return view('yonetim.salestype',
                compact('pagetitle',
                    'toplamciro', 'toplamciroadet', 'ayliktoplam', 'ayliktoplamadet',
                    'aylar', 'ay', 'yil', 'gunler', 'siparisler'));
        }
    }

    public function cash(){
        if(Auth::guard('yonetim')->check()) {
            $ay = request('ay');
            $yil = request('yil');
            $today = "";
            $gunler = "";
            $gun = "";
            $siparisler = "";
            if ($ay == null) {
                $today = Carbon::now();
                $ay = $today->month;
                $yil = $today->year;
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            } else {
                $today = Carbon::now()->year($yil)->month($ay);
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            }

            $aylar = [1 => "Ocak", 2 => "Şubat", 3 => "Mart", 4 => "Nisan", 5 => "Mayıs", 6 => "Haziran", 7 => "Temmuz", 8 => "Ağustos", 9 => "Eylül", 10 => "Ekim", 11 => "Kasım", 12 => "Aralık"];


            $pagetitle = "Kapıda Nakit Satışları";
            // Toplam Ciro
            $toplamciro = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Sum('totalprice');

            $toplamciroadet = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Count('orderno');

            // Aylık Ciro
            $ayliktoplam = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Sum('totalprice');

            $ayliktoplamadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '!=', 6)
                ->where('order.ref_paymentmethod', '=', 3)
                ->Count('orderno');

            $siparisler = DB::table('order')
                ->where('order.ref_orderstatus', '!=', 6)
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->where('order.ref_paymentmethod', '=', 3)
                ->get();

            switch ($ay) {
                case 1:
                    $ay = "Ocak";
                    break;
                case 2:
                    $ay = "Şubat";
                    break;
                case 3:
                    $ay = "Mart";
                    break;
                case 4:
                    $ay = "Nisan";
                    break;
                case 5:
                    $ay = "Mayıs";
                    break;
                case 6:
                    $ay = "Haziran";
                    break;
                case 7:
                    $ay = "Temmuz";
                    break;
                case 8:
                    $ay = "Ağustos";
                    break;
                case 9:
                    $ay = "Eylül";
                    break;
                case 10:
                    $ay = "Ekim";
                    break;
                case 11:
                    $ay = "Kasım";
                    break;
                case 12:
                    $ay = "Aralık";
                    break;
            }

            return view('yonetim.salestype',
                compact('pagetitle',
                    'toplamciro', 'toplamciroadet', 'ayliktoplam', 'ayliktoplamadet',
                    'aylar', 'ay', 'yil', 'gunler', 'siparisler'));
        }
    }

    public function cancelled(){
        if(Auth::guard('yonetim')->check()) {
            $ay = request('ay');
            $yil = request('yil');
            $today = "";
            $gunler = "";
            $gun = "";
            $siparisler = "";
            if ($ay == null) {
                $today = Carbon::now();
                $ay = $today->month;
                $yil = $today->year;
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            } else {
                $today = Carbon::now()->year($yil)->month($ay);
                $gunler = [];
                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                    $gunler[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                }
            }

            $aylar = [1 => "Ocak", 2 => "Şubat", 3 => "Mart", 4 => "Nisan", 5 => "Mayıs", 6 => "Haziran", 7 => "Temmuz", 8 => "Ağustos", 9 => "Eylül", 10 => "Ekim", 11 => "Kasım", 12 => "Aralık"];


            $pagetitle = "İptal Edilen Satışlar";
            // Toplam Ciro
            $toplamciro = DB::table('order')
                ->where('order.ref_orderstatus', '=', 6)
                ->Sum('totalprice');

            $toplamciroadet = DB::table('order')
                ->where('order.ref_orderstatus', '=', 6)
                ->Count('orderno');

            // Aylık Ciro
            $ayliktoplam = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '=', 6)
                ->Sum('totalprice');

            $ayliktoplamadet = DB::table('order')
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->where('order.ref_orderstatus', '=', 6)
                ->Count('orderno');

            $siparisler = DB::table('order')
                ->where('order.ref_orderstatus', '=', 6)
                ->whereMonth('orderdate', '=', $ay)
                ->whereYear('orderdate', '=', $yil)
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->get();

            switch ($ay) {
                case 1:
                    $ay = "Ocak";
                    break;
                case 2:
                    $ay = "Şubat";
                    break;
                case 3:
                    $ay = "Mart";
                    break;
                case 4:
                    $ay = "Nisan";
                    break;
                case 5:
                    $ay = "Mayıs";
                    break;
                case 6:
                    $ay = "Haziran";
                    break;
                case 7:
                    $ay = "Temmuz";
                    break;
                case 8:
                    $ay = "Ağustos";
                    break;
                case 9:
                    $ay = "Eylül";
                    break;
                case 10:
                    $ay = "Ekim";
                    break;
                case 11:
                    $ay = "Kasım";
                    break;
                case 12:
                    $ay = "Aralık";
                    break;
            }

            return view('yonetim.salestype',
                compact('pagetitle',
                    'toplamciro', 'toplamciroadet', 'ayliktoplam', 'ayliktoplamadet',
                    'aylar', 'ay', 'yil', 'gunler', 'siparisler'));
        }
    }
}
