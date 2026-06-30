<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Subject $subject)
    {
        return view('posts.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:explanation,summary,blog',
        ]);

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'user_id' => Auth::id(),
            'subject_id' => $subject->id,
        ]);

        return redirect()->route('subjects.show', $subject)->with('success', 'Bericht succesvol geplaatst!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:explanation,summary,blog',
        ]);

        $post->update($validated);

        return redirect()->route('subjects.show', $post->subject)->with('success', 'Bericht succesvol bijgewerkt!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $subject = $post->subject;
        $post->delete();
        return redirect()->route('subjects.show', $subject)->with('success', 'Bericht succesvol verwijderd!');
    }
}
