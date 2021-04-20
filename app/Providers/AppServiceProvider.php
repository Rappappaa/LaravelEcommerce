<?php

namespace App\Providers;

use App\Models\BasketItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductProperty;
use App\Models\ProductVote;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        $_kargo_ucreti = 9;
        $_categories = Category::Where(['active' => true, 'upperid' => null])->get();
        $_sub_categories = Category::Where('active', true)->WhereRaw('upperid is not null')->get();
        $_all_products = Product::WhereRaw('active',true)->get();
        $_products = Product::WhereRaw('active',true)->GroupBy('name')->get();
        $_product_images = ProductImage::WhereRaw('active',true)->get();
        $_product_properties = ProductProperty::All();
        $_product_categories = ProductCategory::All();
        $_product_votes = ProductVote::WhereRaw('active',true)->avg('value');
        $_basket_items = BasketItem::WhereRaw('ref_basket is null')->get();
        View::share('_categories',$_categories);
        View::share('_sub_categories',$_sub_categories);
        View::share('_all_products',$_all_products);
        View::share('_products',$_products);
        View::share('_product_images',$_product_images);
        View::share('_product_properties',$_product_properties);
        View::share('_product_categories',$_product_categories);
        View::share('_product_votes',$_product_votes);
        View::share('_basket_items',$_basket_items);
        View::share('_kargo_ucreti',$_kargo_ucreti);
    }
}
