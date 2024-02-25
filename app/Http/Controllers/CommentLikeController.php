<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function commentlike(Request $request){
        $postid=$request->input('postid');
        $commentId=$request->input('commentId');
        $userid=Auth::user()->id;
        CommentLike::create([
            'user_id'=>$userid,
            'post_id'=>$postid,
            'comment_id'=>$commentId
        ]);
        return response()->json(['message' => "Hello from PHP method! $postid $userid $commentId"]);
    }
}
