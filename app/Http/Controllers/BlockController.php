<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BlockController extends Controller
{
    //Block method
    public function block(User $user)
    {
        $blocker = auth()->user();
        $blocker->block()->attach($user->id);
        $blocker->followings()->detach($user->id);
        return redirect()->back();
    }

    //Unblock method
    public function unblock(User $user)
    {
        $blocker = auth()->user();
        $blocker->block()->detach($user->id);
        return redirect()->back();
    }
}
