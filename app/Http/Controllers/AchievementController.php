<?php
// app/Http/Controllers/AchievementController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class AchievementController extends Controller
{
    /**
     * Controleer en ken achievements toe aan een gebruiker
     */
    public function checkAndAwardAchievements($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return;
        }

        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            // Check of de gebruiker deze achievement al heeft
            if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                continue;
            }

            if ($this->checkAchievementCondition($user, $achievement)) {
                $user->achievements()->attach($achievement);
            }
        }
    }

    /**
     * Controleer of een gebruiker voldoet aan de voorwaarden voor een achievement
     */
    private function checkAchievementCondition($user, $achievement)
    {
        switch ($achievement->slug) {
            case 'first-post':
                return $user->posts()->count() >= 1;

            case 'helpful-student':
                $likesReceived = $this->getLikesReceived($user);
                return $likesReceived >= 10;

            case 'top-contributor':
                return $user->posts()->count() >= 5 &&
                    $user->comments()->count() >= 10;

            case 'help-10-students':
                return $user->comments()->count() >= 10;

            case 'knowledge-sharer':
                return $user->posts()->count() >= 3;

            default:
                return false;
        }
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
     * Toon alle achievements
     */
    public function index()
    {
        $achievements = Achievement::all();
        $userAchievements = auth()->user()->achievements()->pluck('achievement_id')->toArray();

        return view('achievements.index', compact('achievements', 'userAchievements'));
    }
}
