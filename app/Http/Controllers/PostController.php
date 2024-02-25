<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        $userid = Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->get();
        return view('posts.home', ['posts' => $posts, 'like' => $like, 'userid' => $userid]);
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
                'croppedImageDataUrls.*' => 'required',
            ]);
            $post = new Post();
            $post->caption = $request->caption;
            $post->hashtag = json_encode($request->hashtag);
            $post->user_id = Auth::user()->id;
            $post->save();

  // Decode the JSON string containing croppedImageDataUrls
$croppedImageDataUrls = json_decode($request->croppedImageDataUrls);

foreach ($croppedImageDataUrls as $imageDataUrl) {
    // Remove the data URI scheme from the image URL
    $imageDataUrl = preg_replace('#^data:image/\w+;base64,#i', '', $imageDataUrl);
    // Decode the base64-encoded image data into binary data
    $imageData = base64_decode($imageDataUrl);
    // Generate a unique filename for the image
    $filename = uniqid() . '.png';
    // Store the image file in the public/images directory
    $path = public_path('images/' . $filename);
    // Save the image file to the server
    file_put_contents($path, $imageData);

    // Save the image path to the database
    $media = new Media();
    $media->media_url = $filename;
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

    public function like(Request $request)
    {
        $id = $request->input('id');
        $userid = Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->where('post_id', $id)->first();
        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $userid,
                'post_id' => $id
            ]);
        }



        return response()->json(['message' => "Hello from PHP method! $id"]);
    }
}
