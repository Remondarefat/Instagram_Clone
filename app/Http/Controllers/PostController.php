<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
            // dd($request->all());
            $request->validate([
                'caption' => 'string',
                'hashtag' => 'array',
                'croppedImageDataUrls.*' => 'required|string',
            ]);
            $post = new Post();
            $post->caption = $request->caption;
            $post->hashtag = json_encode($request->hashtag);
            $post->user_id = Auth::user()->id;
            $post->save();

   // Decode the JSON string containing croppedImageDataUrls
   $croppedImageDataUrls = json_decode($request->croppedImageDataUrls);

   foreach ($croppedImageDataUrls as $imageDataUrl) {
       $image = base64_decode(preg_replace('#data:image/\w+;base64,#i', '', $imageDataUrl));

       $path = Storage::disk('public')->put('images', $image);

       $media = new Media();
       $media->media_url = $path;
       $media->post_id = $post->id;
       $media->save();
   }
    return redirect()->back()->with('success', 'Post created successfully'); 
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
