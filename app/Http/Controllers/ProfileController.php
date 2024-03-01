<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\View\View;
use App\Models\CommentLike;
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

        return view('profile.edit');

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
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
        $posts = Post::all();
        $comments=Comment::all();
        $commentlike=CommentLike::all();
        $userid = Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->get();

        return view('posts.home', ['commentlike'=>$commentlike,'posts' => $posts, 'like' => $like, 'userid' => $userid,'comments'=>$comments]);

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
