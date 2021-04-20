<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class CargoExport implements FromCollection
//{
//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
//        return $cargos = DB::table('order')
//            ->where('ref_orderstatus','=','6')
//            ->join('user','user.id','=','order.ref_user')
//            ->join('payment_method','payment_method.id','=','order.ref_paymentmethod')
//            ->join('address','address.id','=','order.ref_address')
//            ->join('city','city.cityid','=','address.ref_city')
//            ->join('district','district.districtid','=','address.ref_district')
//            ->get();
//    }
//}

class CargoExport implements  FromView
{
    public function view(): View
    {
        $cargos = DB::table('order')
        ->where('ref_orderstatus','=','3')
        ->join('user','user.id','=','order.ref_user')
        ->join('payment_method','payment_method.id','=','order.ref_paymentmethod')
        ->join('address','address.id','=','order.ref_address')
        ->join('city','city.cityid','=','address.ref_city')
        ->join('district','district.districtid','=','address.ref_district')
        ->get();

        $_cargos = DB::table('order')
            ->where('ref_orderstatus','=','3')
            ->update(['order.ref_orderstatus' => '4']);

        return view('yonetim.layouts.cargoexport',compact('cargos'));

    }
}
