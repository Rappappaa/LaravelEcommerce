<?php

namespace App\Http\Controllers;

use App\Models\BasketItem;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Slider;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $url = url()->current();
        SEOMeta::setTitle('GFree - Türkiyenin İlk Glutensiz Kuruyemişçisi');
        SEOTools::setDescription('65 yıldır Sağlıklı, Doğal ve En Taze Kuruyemişin vazgeçilmez adresi. GFree Glutensiz Kuruyemiş!');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');

        $sliders = Slider::Where('active',true)->get();
        $featureds = Product::Where(['featured' => true, 'active' => true])->get();
//        $encoksatan = Product::select('product.id')
//            ->join('basket_item','basket_item.ref_product','=','product.id')
//            ->GroupBy('basket_item.ref_product')
//            ->OrderBy('basket_item.quantity', 'DESC')
//            ->Sum('basket_item.quantity')
//            ->First();
//        $single_product = Product::Find($encoksatan->id);
        $single_product = Product::inRandomOrder()->Where('active',true)->limit(1)->First();
        $most_sellers = Product::inRandomOrder()->Where('active',true)->limit(6)->get();
        $new_arrivals = Product::Where('active',true)->orderBy('id', 'DESC')->limit(6)->get();
        $blogs = Blog::Where('active',true)->orderBy('id','DESC')->limit(5)->get();
        return view('home', compact('sliders','featureds','single_product','most_sellers','new_arrivals','blogs'));

    }
}
