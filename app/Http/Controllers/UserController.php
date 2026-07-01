<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UserController extends Controller
{
    /**
     * Toon het profiel van een gebruiker
     */
    public function show(User $user)
    {
        // Haal de posts en comments van de gebruiker op
        $posts = $user->posts()->with(['subject', 'likes'])->latest()->paginate(10);
        $comments = $user->comments()->with(['post'])->latest()->paginate(10);

        // Bereken statistieken voor de gebruiker
        $stats = [
            'total_posts' => $user->posts()->count(),
            'total_comments' => $user->comments()->count(),
            'total_likes_received' => $this->getLikesReceived($user),
            'achievements_count' => $user->achievements()->count(),
            'member_since' => $user->created_at->format('d-m-Y'),
        ];

        return view('users.show', compact('user', 'posts', 'comments', 'stats'));
    }

    /**
     * Bereken het totaal aantal likes dat een gebruiker heeft ontvangen
     */
    private function getLikesReceived($user)
    {
        $postLikes = $user->posts->sum(function($post) {
            return $post->likes()->count();
        });

        $commentLikes = $user->comments->sum(function($comment) {
            return $comment->likes()->count();
        });

        return $postLikes + $commentLikes;
    }

    /**
     * Toon de leaderboard
     */
    public function leaderboard()
    {
        $users = User::withCount(['posts', 'comments'])
            ->with(['achievements'])
            ->get()
            ->map(function($user) {
                // Bereken totale punten
                $user->total_points = $user->achievements->sum('points') +
                    $this->getLikesReceived($user);

                // Voeg extra statistieken toe
                $user->total_interactions = $user->posts->count() + $user->comments->count();

                return $user;
            })
            ->sortByDesc('total_points')
            ->take(10);

        return view('leaderboard.index', compact('users'));
    }
}
