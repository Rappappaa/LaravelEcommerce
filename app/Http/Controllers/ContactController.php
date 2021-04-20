<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(){
        $url = url()->current();
        SEOTools::setTitle('GFree - İletişim');
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->setUrl($url);

        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::jsonLd()->addImage('../images/logo.png');
        return view('contact');
    }

    public function send(Request $request){
        $to_name = config('app.name');
        $to_email = 'info@glutensizkuruyemis.com';
        $data = array('name'=>request('namesurname'),'email' => request('email'),'konu' => request('konu'), "body" => request('mesaj'));
        Mail::send('layouts.partials.contactcontext', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject(request('konu'));
            $message->from(request('email'),request('namesurname'));
        });
        Toastr::success('Mesajınız için teşekkürler.','Mesaj Gönderildi');
        return redirect()->route('contact');
    }
}
