<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\ProductVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Tüm Yorumlar";
            $commentcount = ProductVote::All()->Count();
            $votes = ProductVote::All();
            return view('yonetim.votes', compact('pagetitle', 'commentcount', 'votes'));
        }
    }

    public function active_votes(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Aktif Yorumlar";
            $commentcount = ProductVote::Where('active', true)->get()->Count();
            $votes = ProductVote::Where('active', true)->get();
            return view('yonetim.votes', compact('pagetitle', 'commentcount', 'votes'));
        }
    }

    public function passive_votes(){
        if(Auth::guard('yonetim')->check()) {
            $pagetitle = "Pasif Yorumlar";
            $commentcount = ProductVote::Where('active', false)->get()->Count();
            $votes = ProductVote::Where('active', false)->get();
            return view('yonetim.votes', compact('pagetitle', 'commentcount', 'votes'));
        }
    }
    public function active_votes_action(){
        if(Auth::guard('yonetim')->check()) {
            $commentid = request('commentid');
            if ($commentid != null) {
                $comment = ProductVote::Where('id', $commentid)
                    ->update(['active' => true]);
            }
            return redirect()->route('yonetim.active_votes');
        }
    }

    public function passive_votes_action(){
        if(Auth::guard('yonetim')->check()) {
            $commentid = request('commentid');
            if ($commentid != null) {
                $comment = ProductVote::Where('id', $commentid)
                    ->update(['active' => false]);
            }
            return redirect()->route('yonetim.passive_votes');
        }
    }
}
