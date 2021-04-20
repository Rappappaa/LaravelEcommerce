<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $todays_orders = DB::table('order')
                ->whereDate('order.orderdate', '=', Carbon::now())
                ->Count();

            $todays_ciro = DB::table('order')
                ->whereDate('order.orderdate', '=', Carbon::now())
                ->Sum('order.totalprice');

            $last_orders = DB::table('order')
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('order_status', 'order_status.id', '=', 'order.ref_orderstatus')
                ->OrderBy('orderdate', 'DESC')
                ->get();

            $total_user = DB::table('user')
                ->Count();

            $total_blog = DB::table('blog')
                ->Count();

            $urunler = Product::Where('active',true)->get();

            return view('yonetim.home', compact('last_orders', 'todays_orders', 'todays_ciro', 'total_user', 'total_blog','urunler'));
        }
    }
}
