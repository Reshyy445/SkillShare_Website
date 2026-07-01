<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\User;

class AchievementController extends Controller
{
    public function checkAndAwardAchievements($userId)
    {
        $user = User::find($userId);
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            if ($this->checkAchievementCondition($user, $achievement)) {
                $user->achievements()->attach($achievement);
            }
        }
    }

    private function checkAchievementCondition($user, $achievement)
    {
        switch ($achievement->slug) {
            case 'first-post':
                return $user->posts()->count() >= 1;
            case 'helpful-student':
                return $user->posts()->sum(function($post) {
                        return $post->likes()->count();
                    }) >= 10;
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

    public function leaderboard()
    {
        $users = User::withCount(['posts', 'comments'])
            ->with(['achievements'])
            ->get()
            ->map(function($user) {
                $user->total_points = $user->achievements->sum('points') +
                    $user->posts->sum(function($post) {
                        return $post->likes()->count();
                    }) +
                    $user->comments->sum(function($comment) {
                        return $comment->likes()->count();
                    });
                return $user;
            })
            ->sortByDesc('total_points')
            ->take(10);

        return view('leaderboard.index', compact('users'));
    }
}
