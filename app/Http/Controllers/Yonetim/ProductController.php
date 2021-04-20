<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $products = Product::all();
            $productsadet = Product::all()->Count();
            $pagetitle = "Tüm Ürünler";
            return view('yonetim.products', compact('products', 'productsadet', 'pagetitle'));
        }
    }

    public function aktif_urunler(){
        if(Auth::guard('yonetim')->check()) {
            $products = Product::Where('active', 1)->get();
            $productsadet = Product::Where('active', 1)->get()->Count();
            $pagetitle = "Aktif Ürünler";
            $productid = request('productid');
            if ($productid != null) {
                $user = Product::Where('id', $productid)
                    ->update(['active' => false]);
                return redirect()->route('yonetim.products_active');
            }
            return view('yonetim.products', compact('products', 'productsadet', 'pagetitle'));
        }
    }

    public function pasif_urunler(){
        if(Auth::guard('yonetim')->check()) {
            $products = Product::Where('active', 0)->get();
            $productsadet = Product::Where('active', 0)->get()->Count();
            $pagetitle = "Pasif Ürünler";
            $productid = request('productid');
            if ($productid != null) {
                $user = Product::Where('id', $productid)
                    ->update(['active' => true]);
                return redirect()->route('yonetim.products_passive');
            }

            return view('yonetim.products', compact('products', 'productsadet', 'pagetitle'));
        }
    }

    public function edit_product(){
        if(Auth::guard('yonetim')->check()) {
            $mode = request('mode');
            $productid = request('productid');
            $product = Product::find($productid);
            $pagetitle = "";
            if ($mode == "view") {
                if ($product == null) $pagetitle = "Ürün Ekleme";
                if ($product != null) $pagetitle = "Ürün Düzenleme";

                return view('yonetim.editproduct', compact('pagetitle', 'product'));
            }
            if ($mode == "add") {

            }
            if ($mode == "update") {

            }
            return redirect()->route('yonetim.home');
        }

    }
}
