<?php

namespace App\Http\Controllers;

use App\Models\Like;
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
            'hashtag' => ['string', 'regex:/#[a-zA-Z0-9]+/'],
            'croppedImageDataUrls.*' => 'required|exists:request|array|min:1',
            // 'user_id' => 'required',
            // 'post_id' => 'required',
        ]);
        $post = new Post();
        $post->caption = $request->caption;
        $post->hashtag = $request->hashtag;
        $post->user_id = Auth::user()->id;
        $post->save();

        // Save each cropped image as a Media instance related to the post
        if (is_array($request->croppedImageDataUrls) || is_object($request->croppedImageDataUrls)) {
            foreach ($request->croppedImageDataUrls as $croppedImageDataUrl) {
                // Extract base64 image data
                $data = explode(',', $croppedImageDataUrl)[1];
                // Create Media instance and save it
                $mediaItem = new Media();
                $mediaItem->media_url = $data; // Store base64 encoded image data
                $mediaItem->post_id = $post->id; // Ensure the post_id is set correctly
                $mediaItem->save();
            }
        } else {
            // Handle the case where $request->croppedImageDataUrls is not an array or an object
            // For example, you can return an error response or log the issue
            dd('Error: $request->croppedImageDataUrls is not an array or an object');
        }
        return redirect()->back()->with('success', 'post created');
    }
    private function compressAndStoreImage($imageDataUrl, $quality = 75)
    {
        // Remove the data URL prefix
        $data = substr($imageDataUrl, strpos($imageDataUrl, ',') + 1);

        // Decode the base64 encoded image data
        $decodedImage = base64_decode($data);

        // Create an image resource from the decoded image data
        $image = imagecreatefromstring($decodedImage);

        // Compress the image
        ob_start();
        imagejpeg($image, null, $quality);
        $compressedImageDataUrl = 'data:image/jpeg;base64,' . base64_encode(ob_get_clean());

        // Destroy the image resource
        imagedestroy($image);

        return $compressedImageDataUrl;
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
