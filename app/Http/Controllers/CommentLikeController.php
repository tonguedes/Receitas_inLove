<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentLikeController extends Controller
{
     public function toggle(Comment $comment)
    {
        $user = auth()->user();

        if ($comment->isLikedBy($user)) {
            $comment->likes()->where('user_id', $user->id)->delete();
        } else {
            $comment->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }
}