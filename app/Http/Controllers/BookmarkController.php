<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()->with('post.subject')->paginate(15);
        return view('bookmarks.index', compact('bookmarks'));
    }

    public function toggle(Post $post)
    {
        $bookmark = Bookmark::where([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ])->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['bookmarked' => false]);
        }

        Bookmark::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return response()->json(['bookmarked' => true]);
    }
}
