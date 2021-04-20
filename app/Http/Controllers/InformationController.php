<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function aboutus(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Hakkımızda');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('aboutus');
    }

    public function mss(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Mesafeli Satış Sözleşmesi');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function privacy(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Gizlilik Politikamız');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function salepoints(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Satış Noktalarımız');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function delivery(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Kargo & Teslimat');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function sitemap(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Site Haritası');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function obf(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Ön Bilgilendirme Formu');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }
}
