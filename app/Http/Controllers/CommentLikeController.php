<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function commentlike(Request $request){
        $postid=$request->input('postid');
        $commentId=$request->input('commentId');
        $userid=Auth::user()->id;
        $comment = commentlike::where('user_id', $userid)->where('post_id', $postid)->where('comment_id', $commentId)->first();

        if ($comment) {
            $comment->delete();
        } else {
            CommentLike::create([
                'user_id'=>$userid,
                'post_id'=>$postid,
                'comment_id'=>$commentId
            ]);
        }

        return response()->json(['message' => "Hello from PHP method! $postid $userid $commentId"]);
    }

    // !------- CommentLike PostDesc---------
    public function toggleCommentLike($commentId)
    {
        // Retrieve the comment
        $comment = Comment::findOrFail($commentId);
        $user = auth()->user();

        // Retrieve the post_id associated with the comment
        $postId = $comment->post_id;

        // Check if the user has already liked the comment
        $existingLikeComment = CommentLike::where('user_id', $user->id)
            ->where('comment_id', $commentId) // Use $commentId instead of $comments->id
            ->first();

        if ($existingLikeComment) {
            // If already liked, unlike the comment
            $existingLikeComment->delete();
        } else {
            // If not liked, create a like record
            $like = new CommentLike();
            $like->user_id = $user->id;
            $like->comment_id = $commentId; // Use $commentId instead of $comments->id
            $like->post_id = $postId; // Assign the post_id
            $like->save();
        }

        // Redirect back or return a response as needed
        return redirect()->back();
    }
    }
    

