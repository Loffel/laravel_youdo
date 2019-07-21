<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(Auth::user()->is_admin) return $next($request);
            else return redirect(route('home'));
        });
    }

    public function index(){
        $unactive = User::where('is_verified', 0)->get();
        $proposals = Proposal::all();

        return view('admin.index', array('unactive' => $unactive, 'proposals' => $proposals));
    }

    public function activateUser($user_id){
        $user = User::find($user_id);
        $user->is_verified = 1;
        $user->save();

        return redirect()->back();
    }
}
