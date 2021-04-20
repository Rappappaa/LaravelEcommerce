<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    public function partnership(){
        $url = url()->current();
        SEOTools::setTitle('GFree - İş Ortaklığı');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function sponsorship(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Sponsorluk');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }

    public function distributor(){
        $url = url()->current();
        SEOTools::setTitle('GFree - Bayilik');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('hazirlaniyor');
    }
}
