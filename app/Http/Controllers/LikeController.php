<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // !--------------------------------------
    public function toggleLike($postId)
{
    $post = Post::findOrFail($postId);
    $user = auth()->user();

    // Check if the user has already liked the post
    $existingLike = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

    if ($existingLike) {
        // If already liked, unlike the post
        $existingLike->delete();
    } else {
        // If not liked, create a like record
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();
    }
    // Redirect back or return a response as needed
    return redirect()->back();
    
}
}