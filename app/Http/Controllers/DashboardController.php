<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Basis statistieken
        $stats = [
            'total_posts' => $user->posts()->count(),
            'total_comments' => $user->comments()->count(),
            'total_likes_received' => $this->getLikesReceived($user),
            'achievements_count' => $user->achievements()->count(),
            'bookmarks_count' => $user->bookmarks()->count(),
            'daily_active' => User::whereDate('last_login_at', today())->count(),
            'weekly_active' => User::where('last_login_at', '>=', now()->subDays(7))->count(),
            'subjects' => Subject::count(),
            'posts' => Post::count(),
        ];

        $recentPosts = Post::with(['user', 'subject'])
            ->latest()
            ->take(5)
            ->get();

        // Controleer of de AchievementController bestaat voordat we hem aanroepen
        if (class_exists(\App\Http\Controllers\AchievementController::class)) {
            app(\App\Http\Controllers\AchievementController::class)->checkAndAwardAchievements($user->id);
        }

        return view('dashboard.index', compact('recentPosts', 'stats'));
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
}
