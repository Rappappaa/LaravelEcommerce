<?php

namespace App\Http\Controllers\Yonetim;

use App\Exports\CargoExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $tarih = Carbon::now()->toDateString();
            $dosyaadi = $tarih . " Kargolar.xls";

            $cargos = DB::table('order')
                ->where('order.ref_orderstatus', '=', '3')
                ->join('user', 'user.id', '=', 'order.ref_user')
                ->join('payment_method', 'payment_method.id', '=', 'order.ref_paymentmethod')
                ->join('address', 'address.id', '=', 'order.ref_address')
                ->join('city', 'city.cityid', '=', 'address.ref_city')
                ->join('district', 'district.districtid', '=', 'address.ref_district')
                ->get();

            $excel = new CargoExport($cargos);

            return Excel::download($excel, $dosyaadi);
        }
    }
}
