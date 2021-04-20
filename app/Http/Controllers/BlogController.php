<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function blogmain(){
        /*
        $blog_categories = BlogCategory::Where('active',true)->get();
        return view('blog',compact('blog_categories'));
        */
        $url = url()->current();
        SEOTools::setTitle('GFree - Blog');
        SEOTools::setDescription('Glutensiz Blog Yazılarımızı Mutlaka Okuyun!');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');

        return view('hazirlaniyor');
    }

    public function blog_category(){
        /*
        $blog_categories = BlogCategory::Where('active',true)->get();
        return view('blog',compact('blog_categories'));
        */
        $url = url()->current();
        SEOTools::setTitle('GFree - Blog');
        SEOTools::setDescription('Glutensiz Blog Yazılarımızı Mutlaka Okuyun!');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }
}
