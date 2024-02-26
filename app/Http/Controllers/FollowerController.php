<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    //Following method
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user->id);
        return redirect()->back();
    }

    //Unfollowing method
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user->id);
        return redirect()->back();
    }
}
