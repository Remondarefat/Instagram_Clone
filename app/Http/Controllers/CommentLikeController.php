<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function commentlike(){
        return response()->json(['message' => "Hello from PHP method!"]);
    }
}
