<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show($userID){
        $user = User::findOrFail($userID);

        return view('profile.show', array('user' => $user));
    }
}
