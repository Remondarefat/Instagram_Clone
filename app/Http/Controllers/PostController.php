<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Post_Media;
use App\Models\CommentLike;
use Illuminate\Http\Request;
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
        $comments=Comment::all();
        $commentlike=CommentLike::all();
        $userid = Auth::user()->id;
        $like = Like::where('user_id', Auth::user()->id)->get();
        return view('posts.home', ['commentlike'=>$commentlike,'posts' => $posts, 'like' => $like, 'userid' => $userid,'comments'=>$comments]);
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
                'hashtag_name' => 'string',
                'croppedImageDataUrls.*' => 'required',
                'videoDataUrls.*' => 'required',
            ]);
            $post = new Post();
            $post->caption = $request->caption;
            $post->user_id = Auth::user()->id;
            $post->save();


            // }
            // $post->save();
  // Decode the JSON string containing croppedImageDataUrls
$croppedImageDataUrls = json_decode($request->croppedImageDataUrls);

foreach ($croppedImageDataUrls as $imageDataUrl) {
    // Remove the data URI scheme from the image URL
    $imageDataUrl = preg_replace('#^data:image/\w+;base64,#i', '', $imageDataUrl);
    // Decode the base64-encoded image data into binary data
    $imageData = base64_decode($imageDataUrl);
    // Generate a unique filename for the image

    $filename = uniqid() . '.png';
// Store the image data directly in the storage directory
$path = Storage::put('public/images/' . $filename, $imageData);

$path = str_replace('public/', 'storage/', $path);

    // Save the image path to the database
    $media = new Media();
    $media->media_url = $filename;
    $media->post_id = $post->id;
    $media->save();
}

// Decode the JSON string containing videoDataUrls
$videoDataUrls = json_decode($request->videoDataUrls);

foreach ($videoDataUrls as $videoDataUrl) {

    $videoDataUrl = preg_replace('#^data:video/\w+;base64,#i', '', $videoDataUrl);
    $videoData = base64_decode($videoDataUrl);
    $filename = uniqid() . '.mp4';
    $path = Storage::put('public/images/' . $filename, $videoData);
    $path = str_replace('public/', 'storage/', $path);
    $media = new Media();
    $media->media_url = $filename;
    $media->post_id = $post->id;
    $media->save();
}

if ($request->has('hashtag_name')) {
    $hashtags = $request['hashtag_name'];
    $hashtagsArray = explode(' ', $hashtags);
    foreach ($hashtagsArray as $tag) {
        $hashtag = new Hashtag();
        $hashtag->hashtag_name = $tag;
        $hashtag->post_id = $post->id;
        $hashtag->save();
    }

}
    return redirect()->back()->with('success', 'Post created successfully');
        }


//         public function getPostsByHashtag($hashtag)
// {
//     // Find the hashtag by name
//     $hashtagModel = Hashtag::where('name', $hashtag)->first();

//     // If the hashtag exists, retrieve posts associated with it
//     if ($hashtagModel) {
//         $posts = $hashtagModel->posts()->get();
//         return view('posts.by_hashtag', compact('posts'));
//     } else {
//         // Handle case when hashtag doesn't exist
//         // For example, return a message or redirect
//     }
// }


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


    public function comment(Request $request){

        $postid=$request->input('id');
        $postcomment=$request->input('postcomment');
        $userid=Auth::user()->id;
        Comment::create([
            'user_id'=>$userid,
            'post_id'=>$postid,
            'comment_body'=>$postcomment
        ]);
        return response()->json(['message' => "Hello from PHP method! $postcomment"]);

    }


}
