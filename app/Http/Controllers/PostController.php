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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        $userid=Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->get();
        return view('posts.home',['posts'=>$posts,'like'=>$like,'userid'=>$userid]);
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
            'hashtag' => ['string' , 'regex:/#[a-zA-Z0-9]+/'],
            'imageDataUrl' => 'required',
        ] );

        // Create a new post instance
        $post = new Post();
        $post->caption = $request->caption;
        $post->hashtag = $request->hashtag;
        $post->user_id = Auth::user()->id;
        $post->save();

        if ($request->imageDataUrl) {
            $compressedImageDataUrl = $this->compressAndStoreImage($request->imageDataUrl);

            $mediaItem = new Media();
            $mediaItem->media_url = $compressedImageDataUrl;
            $mediaItem->post_id = $post->id;
            $mediaItem->save();

            }
            return redirect()->back()->with('success', 'post created');

        }
        private function compressAndStoreImage($imageDataUrl, $quality = 75) {
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
        $id=$request->input('id');
        $userid=Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->where('post_id', $id)->first();
        if ($like){
            $like->delete();
        }
        else{
            Like::create([
                'user_id'=>$userid,
                'post_id'=>$id
            ]);
        }



        return response()->json(['message' => "Hello from PHP method! $id"]);
    }
}
