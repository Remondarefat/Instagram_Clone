<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialLoginController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();

    }
    public function callback($provider){
        $user= Socialite::driver($provider)->user();
        dd($user);
    }
}
