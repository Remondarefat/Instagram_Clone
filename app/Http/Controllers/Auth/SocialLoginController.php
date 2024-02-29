<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

// try {
//     $provider_user = Socialite::driver($provider)->user();
//     $user = User::where([
//         'provider' => $provider,
//         'provider_id' => $provider_user->getId(),
//     ])->first();

//     if (!$user) {
//         // Check if the user's email already exists
//         $existingUser = User::where('email', $provider_user->getEmail())->first();

//         if ($existingUser) {
//             // User already exists, log them in
//             Auth::login($existingUser);
//             return redirect('/posthome');
//         }

//         // User doesn't exist, create a new one
//         $user = User::create([
//             'name' => $provider_user->getName(),
//             'email' => $provider_user->getEmail(),
//             'password' => Hash::make(Str::random(8)),
//             'provider' => $provider,
//             'provider_id' => $provider_user->getId(),
//             'provider_token' => $provider_user->token,
//         ]);
//     }

//     Auth::login($user);
//     return redirect('/posthome');
// } catch (Exception $e) {
//     return redirect()->route('login')->with('error', 'Failed to login with ' . ucfirst($provider));
// }

