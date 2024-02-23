<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_Media;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.postDesc');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'caption' => 'string',
            'hashtag' => 'string',
        ]);
    // dd($request->all());  
    //  dd($request->imageDataUrl);
     
     
        // Create a new post instance
        $post = new Post();
        $post->caption = $request->caption;
        $post->hashtag = $request->hashtag;
        $post->user_id = Auth::user()->id;
        $post->save();
    // dd( gettype( $request->imageDataUrl));
        if ($request->imageDataUrl) {

            $mediaItem = new Media();
            $mediaItem->media_url = $request->imageDataUrl;
            $mediaItem->post_id = $post->id;
            $mediaItem->save();
            
            }
            return redirect()->back()->with('success', 'post created'); 

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
}
