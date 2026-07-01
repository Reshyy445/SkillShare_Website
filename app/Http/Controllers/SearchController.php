<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type', 'all');

        $results = [
            'posts' => [],
            'subjects' => [],
            'users' => [],
        ];

        if (strlen($query) >= 2) {
            // Zoek in posts
            $postsQuery = Post::where('title', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%")
                ->with(['user', 'subject']);

            if ($type !== 'all') {
                $postsQuery->where('type', $type);
            }

            $results['posts'] = $postsQuery->paginate(10);

            // Zoek in subjects
            $results['subjects'] = Subject::where('name', 'LIKE', "%{$query}%")
                ->orWhere('education', 'LIKE', "%{$query}%")
                ->get();

            // Zoek in users
            $results['users'] = User::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->take(5)
                ->get();
        }

        return view('search.index', compact('query', 'type', 'results'));
    }
}
