<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;

class SocialController extends Controller
{
  public function redirect($provider) {
    return Socialite::driver($provider)->redirect();
  }
  public function callback($provider) {
    try {
        $provider_user = Socialite::driver($provider)->user();
        $user = User::where([
            'provider' => $provider,
            'provider_id' => $provider_user->getId(),
        ])->first();

        if (!$user) {
            // Check if the user's email already exists
            $existingUser = User::where('email', $provider_user->getEmail())->first();

            if ($existingUser) {
                // User already exists, log them in
                Auth::login($existingUser);
                return redirect('/posthome');
            }

            // User doesn't exist, create a new one
            $user = User::create([
                'name' => $provider_user->getName(),
                'email' => $provider_user->getEmail(),
                'password' => Hash::make(Str::random(8)),
                'provider' => $provider,
                'provider_id' => $provider_user->getId(),
                'provider_token' => $provider_user->token,
            ]);
        }

        Auth::login($user);
        return redirect('/posthome');
    } catch (Exception $e) {
        return redirect()->route('login')->with('error', 'Failed to login with ' . ucfirst($provider));
    }
}

}