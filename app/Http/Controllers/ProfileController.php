<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'bio' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Store the uploaded avatar in public/avatars directory
            $avatarPath = $request->file('avatar')->store('public/avatars');
            // Update the user's avatar path
            $data['avatar'] = $avatarPath;
    }

        $user = Auth::user();

        $userUpdate = User::findOrFail($user->id);
        $userUpdate->update($data);

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
