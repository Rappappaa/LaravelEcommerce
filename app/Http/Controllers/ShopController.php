<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ShopController extends Controller
{
    public function shop(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Glutensiz Mağaza');
        SEOTools::setDescription('Tüm Glutensiz Ürünleri Bulabileceğiniz Mağaza!');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');

        $categories = Category::Where(['upperid' => null, 'type' => 0, 'active' => true])->get();
        $brands = Product::Where('active',true)->GroupBy('brand')->get();
        $weights = Product::Where('active',true)->GroupBy('weight')->get();
        $products = Product::inRandomOrder()->Where('active',true)->get();
        return view('shop', compact('categories','brands','weights','products'));
    }

    public function maincategory($slug)
    {
        $category = Category::Where('slug',$slug)->First();
        if($category != null && $category->upperid == null){
            $sub_categories = Category::Where(['upperid' => $category->id, 'active' => true])->get();
            $product_categories = ProductCategory::All();
            $uppercategory = Category::Where('id', $category->upperid)->First();
            $products = DB::table('category')
                ->where('category.upperid','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->where('product.active','=',true)
                ->get();

            $menu = null;

            $brands = DB::table('category')
                ->where('category.upperid','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.brand')
                ->get();

            $brandsCount = DB::table('category')
                ->where('category.upperid','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->Count();

            $weights = DB::table('category')
                ->where('category.upperid','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.weight')
                ->get();

            $weightsCount = DB::table('category')
                ->where('category.upperid','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.weight')
                ->Count();

            $url = url()->current();
            SEOTools::setTitle('GFree - ' . $category->name);
            SEOTools::setDescription($category->description);
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');

            return view('category', compact('category','sub_categories','product_categories','products','brands','weights','weightsCount','brandsCount','menu','uppercategory'));
        }
        if($category != null && $category->upperid != null){
            $sub_categories = Category::Where('slug',$slug)->get();
            $product_categories = ProductCategory::All();
            $uppercategory = Category::Where('id', $category->upperid)->First();
            $products = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->where('product.active','=',true)
                ->get();

            $menu = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.name')
                ->get();

            $brands = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.brand')
                ->get();

            $brandsCount = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.brand')
                ->Count();

            $weights = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.weight')
                ->get();

            $weightsCount = DB::table('category')
                ->where('category.id','=',$category->id)
                ->join('product_category','product_category.ref_category','=','category.id')
                ->join('product','product.id','=','product_category.ref_product')
                ->GroupBy('product.weight')
                ->Count();

            $url = url()->current();
            SEOTools::setTitle('GFree - ' . $category->name);
            SEOTools::setDescription($category->description);
            SEOTools::setCanonical($url);
            SEOTools::opengraph()->setUrl($url);

            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::jsonLd()->addImage('../images/logo.png');

            return view('category', compact('category','sub_categories','product_categories','products','brands','weights','weightsCount','brandsCount','menu','uppercategory'));
        }


    }

}
