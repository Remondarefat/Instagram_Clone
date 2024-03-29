<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Post_Media;
use App\Models\CommentLike;


use App\Models\User;


use App\Models\PostMedia;

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
        $followings = Auth::user()->followings;
        $posts = Post::whereIn('user_id', $followings->pluck('id'))
        ->latest()
        ->get();
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
            'hashtag_name' => 'string|nullable',
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










    public function show(string $id)
    {
        $post=Post::findorfail($id);
        $user=User::where("id",$post->user_id)->first();
        $medias=Media::where('post_id',$post->id)->get();
        // Fetch more posts by the same user along with media URLs
        $morePosts = Post::where('user_id', $user->id)
        ->where('id', '!=', $post->id) // Exclude the current post
        ->with(['media' => function ($query) {
            $query->select('media_url', 'post_id');
        }])
        ->orderByDesc('created_at')
        ->take(9) // Adjust as needed
        ->get();

        //! Fetch comments associated with the post
        $comments = Comment::where('post_id', $post->id)->get();
        $likes = Like::where('post_id', $post->id)->get();
        // dd($user);
         //! Check if the user has already liked the post
        $user = auth()->user();
        $existingLike = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();
        $existingLikeComments = CommentLike::where('user_id', $user->id)
        ->whereIn('comment_id', $comments->pluck('id')) // Check if user liked any comment in the collection
        ->get();
         // Check if the post is saved by the current user
        // $isSavedByUser = $post->isSavedByUser($user->id);

        return view("posts.postDesc",['post'=>$post,'user' => $user, "medias" => $medias
        ,'existingLike' => $existingLike,'existingLikeComments' => $existingLikeComments,'comments' => $comments,'morePosts' => $morePosts
        ,'likes'=>$likes ]);
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
            $response=['action'=>'unlike'];
        } else {
            Like::create([
                'user_id' => $userid,
                'post_id' => $id
            ]);
            $response=['action'=>'like'];
        }
        $likeCount = Like::where('post_id', $id)->count();



        return response()->json(['action'=>$response,'likeCount'=>$likeCount]);
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
        $comments=Comment::where('post_id',$postid)->get();
        return response()->json(['comments' => $comments]);

    }

    public function hash(string $hash)
    {
        $ha = "#" . $hash;
        $posts = Post::whereHas('hashtags', function ($query) use ($ha) {
            $query->where('hashtag_name', $ha);
        })->get();
        return view ('by_hashtag', ['posts' => $posts, 'hashtag_name' => $ha]);
    }
}
