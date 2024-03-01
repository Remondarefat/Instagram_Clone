<?php

namespace App\Http\Controllers;

use App\Models\PostSaved;
use Illuminate\Http\Request;

class PostSavedController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Retrieve the saved posts for the authenticated user
    $savedPosts = PostSaved::where('user_id', $user->id)
                            ->with(['post' => function ($query) {
                                $query->with(['media', 'like', 'comment']);
                            }])
                            ->get();

    // Calculate likes counts for each saved post
    $likesCounts = [];
    foreach ($savedPosts as $savedPost) {
        $likesCounts[$savedPost->post->id] = $savedPost->post->like->count();
    }

    // Calculate comments counts for each saved post
    $commentsCounts = [];
    foreach ($savedPosts as $savedPost) {
        $commentsCounts[$savedPost->post->id] = $savedPost->post->comment->count();
    }

    return view('posts.savedPosts', compact('savedPosts', 'likesCounts', 'commentsCounts'));
}

    



public function store(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $user = auth()->user();

    // Check if the post is already saved by the user
    $existingSavedPost = PostSaved::where('user_id', $user->id)
                                    ->where('post_id', $request->post_id)
                                    ->exists(); 

    if (!$existingSavedPost) {
        // Create a new saved post record
        PostSaved::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
        ]);
    }

    return redirect()->back();
}


    public function destroy(Request $request)
    {
        
        // Find and delete the saved post record
        PostSaved::where('user_id', $request->user_id)
            ->where('post_id', $request->post_id)
            ->delete();
            cache()->forget('saved-post-' . $request->user_id . '-' . $request->post_id);
    
        return redirect()->back();
    }
    // public function destroy(string $postId)
    // {
    //     $user = Auth::user();
    //     $savedPosts = $user->savedPosts()->where('post_id', $postId)->get();
    //     foreach ($savedPosts as $savedPost) {
    //         $savedPost->delete();
    //     }
    //     return redirect()->back()->with('success', 'All saved posts removed for this post!');
    // }
    
}
