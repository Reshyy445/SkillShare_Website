<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('creator')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);

        Subject::create([
            'name' => $validated['name'],
            'education' => $validated['education'],
            'level' => $validated['level'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Vak succesvol aangemaakt!');
    }

    public function show(Subject $subject)
    {
        $subject->load(['posts' => function($query) {
            $query->with(['user', 'comments.user'])->latest();
        }]);

        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Vak succesvol bijgewerkt!');
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Vak succesvol verwijderd!');
    }
}
