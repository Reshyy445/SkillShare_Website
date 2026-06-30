<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'content' => $validated['content'],
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
        ]);

        return redirect()->route('messages.index')->with('success', 'Bericht succesvol verzonden!');
    }

    public function show(Message $message)
    {
        // Mark as read if user is the receiver
        if ($message->receiver_id === Auth::id() && !$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Bericht succesvol verwijderd!');
    }
}
