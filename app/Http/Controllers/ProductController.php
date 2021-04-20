<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCertificate;
use App\Models\ProductImage;
use App\Models\ProductProperty;
use App\Models\ProductVote;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index($slug)
    {

        $product = Product::Where('slug',$slug)->First();
        $images = ProductImage::Where('ref_product',$product->id)->get();
        $product_properties = ProductProperty::Where('ref_product',$product->id)->get();
        $votes = ProductVote::Where(['ref_product' => $product->id, 'active' => true])->get();
        $product_category = ProductCategory::Where('ref_product',$product->id)->First();
        $category = Category::Where('id',$product_category->ref_category)->First();
        $main_category = Category::Find($category->upperid);
        $same_products = Product::Where('name',$product->name)->get();
        $certificates = ProductCertificate::Where(['ref_product' => $product->id, 'active' => true])->get();
        $users = User::Where('active','=',true)->get();

        $url = url()->current();
        SEOTools::setTitle('GFree - ' . $product->name . ' ' . $product->weight . ' GR');
        SEOTools::setDescription($product->description);
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage($product->image);

        return view('product', compact('product','images','product_properties','category','product_category','same_products','votes','main_category','certificates','users'));
    }
    public function make_comment(){
        if(auth()->check()){
            $vote = request('rate');
            $comment = request('yorum');
            $current_date_time = Carbon::now()->toDateTimeString();
            $add = ProductVote::create([
                'ref_user' => auth()->user()->id,
                'ref_product' => request('productid'),
                'value' => $vote,
                'comment' => $comment,
                'active' => false,
                'date' => $current_date_time
            ]);
            $product = Product::Find(request('productid'));
            Toastr::success('Değerlendirilmeniz incelenmek üzere kayıt edilmiştir.','Değerlendirmeniz için teşekkürler');
            return redirect()->route('product',$product->slug);
        }
    }
}
