<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $recentPosts = Post::with(['user', 'subject'])
            ->latest()
            ->take(5)
            ->get();

        $subjects = Subject::all();

        return view('dashboard.index', compact('recentPosts', 'subjects'));
    }
}
