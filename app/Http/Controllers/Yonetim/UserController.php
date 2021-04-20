<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $users = User::all();
            $usersadet = User::all()->Count();
            $pagetitle = "Tüm Kullanıcılar";
            return view('yonetim.users', compact('users', 'usersadet', 'pagetitle'));
        }
    }

    public function aktif_kullanicilar(){
        if(Auth::guard('yonetim')->check()) {
            $users = User::Where('active', 1)->get();
            $usersadet = User::Where('active', 1)->get()->Count();
            $pagetitle = "Aktif Kullanıcılar";
            $userid = request('userid');
            if ($userid != null) {
                $user = User::Where('id', $userid)
                    ->update(['active' => false]);
                return redirect()->route('yonetim.users_active');
            }
            return view('yonetim.users', compact('users', 'usersadet', 'pagetitle'));
        }
    }

    public function pasif_kullanicilar(){
        if(Auth::guard('yonetim')->check()) {
            $users = User::Where('active', 0)->get();
            $usersadet = User::Where('active', 0)->get()->Count();
            $pagetitle = "Pasif Kullanıcılar";
            $userid = request('userid');
            if ($userid != null) {
                $user = User::Where('id', $userid)
                    ->update(['active' => true]);
                return redirect()->route('yonetim.users_passive');
            }

            return view('yonetim.users', compact('users', 'usersadet', 'pagetitle'));
        }
    }

    public function login_form(){
        if(!Auth::guard('yonetim')->check()) {
            return view('yonetim.login');
        }
    }

    public function login_action(){
        if(!Auth::guard('yonetim')->check()) {
            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('password'),
                'isadmin' => 1
            ];

            if (Auth::guard('yonetim')->attempt($credentials)) {
                return redirect()->route('yonetim.home');
            } else {
                return back();
            }
        }
    }

    public function logout_action(){
        if(Auth::guard('yonetim')->check()) {
            if (Auth::guard('yonetim')->check()) {
                Auth::guard('yonetim')->logout();
                request()->session()->flush();
                request()->session()->regenerate();
                return redirect()->route('yonetim.login_form');
            } else {
                return redirect()->route('home');
            }
        }
    }
}
