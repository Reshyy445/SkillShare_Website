@extends('layouts.app')

@section('title', 'Bericht')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> Bericht</h5>
                        @if(Auth::id() === $message->sender_id)
                            <form method="POST" action="{{ route('messages.destroy', $message) }}"
                                  onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Verwijder
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Van:</strong> {{ $message->sender->name }}
                            <span class="text-muted small">({{ $message->sender->email }})</span>
                        </div>
                        <div class="mb-3">
                            <strong>Aan:</strong> {{ $message->receiver->name }}
                            <span class="text-muted small">({{ $message->receiver->email }})</span>
                        </div>
                        <div class="mb-3">
                            <strong>Verzonden:</strong> {{ $message->created_at->format('d-m-Y H:i') }}
                            @if($message->is_read)
                                <span class="badge bg-success">Gelezen</span>
                            @else
                                <span class="badge bg-warning">Niet gelezen</span>
                            @endif
                        </div>
                        <hr>
                        <div class="message-content">
                            <p>{{ nl2br($message->content) }}</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Terug naar berichten
                            </a>
                            @if(Auth::id() === $message->receiver_id)
                                <a href="{{ route('messages.create') }}" class="btn btn-primary">
                                    <i class="fas fa-reply"></i> Beantwoorden
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
