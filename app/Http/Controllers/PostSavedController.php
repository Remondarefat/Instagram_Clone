<?php

namespace App\Http\Controllers;

use App\Models\PostSaved;
use Illuminate\Http\Request;

class PostSavedController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
        // dd($request->all());

        $user = auth()->user();
        // Check if the post is already saved by the user
        $existingSavedPost = PostSaved::where('user_id', $user->id)
                                        ->where('post_id', $request->post_id)
                                        ->first();

        if ($existingSavedPost) {
            // Post is already saved, do nothing or return a response
        } else {
            // Create a new saved post record
            PostSaved::create([
                'user_id' => $user->id,
                'post_id' => $request->post_id,
            ]);
        }
        // Redirect back or return a response as needed
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
        $user = auth()->user();
        // Find and delete the saved post record
        PostSaved::where('user_id', $user->id)
                    ->where('post_id', $request->post_id)
                    ->delete();
        // Redirect back or return a response as needed
        return redirect()->back();
    }
}
