<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Subject;
use App\Models\Comment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $subjectsCount = Subject::count();
        $commentsCount = Comment::count();

        return view('admin.dashboard', compact(
            'usersCount',
            'postsCount',
            'subjectsCount',
            'commentsCount'
        ));
    }

    public function users()
    {
        $users = User::with('profile')->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Je kunt je eigen account niet verwijderen!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Gebruiker succesvol verwijderd!');
    }

    public function posts()
    {
        $posts = Post::with(['user', 'subject'])->paginate(15);
        return view('admin.posts', compact('posts'));
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts')->with('success', 'Bericht succesvol verwijderd!');
    }

    public function subjects()
    {
        $subjects = Subject::with('creator')->paginate(15);
        return view('admin.subjects', compact('subjects'));
    }

    public function destroySubject(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects')->with('success', 'Vak succesvol verwijderd!');
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'post'])->paginate(15);
        return view('admin.comments', compact('comments'));
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments')->with('success', 'Reactie succesvol verwijderd!');
    }
}
