<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class LikeController extends Controller
{
    public function togglePost(Request $request, Post $post)
    {
        $like = Like::where([
            'user_id' => auth()->id(),
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
        ])->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false, 'count' => $post->likes()->count()]);
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
        ]);

        return response()->json(['liked' => true, 'count' => $post->likes()->count()]);
    }

    public function toggleComment(Request $request, Comment $comment)
    {
        $like = Like::where([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => Comment::class,
        ])->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false, 'count' => $comment->likes()->count()]);
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => Comment::class,
        ]);

        return response()->json(['liked' => true, 'count' => $comment->likes()->count()]);
    }
}
