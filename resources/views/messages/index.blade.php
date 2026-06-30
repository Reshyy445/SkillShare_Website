@extends('layouts.app')

@section('title', 'Berichten')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Berichten</h2>
            <a href="{{ route('messages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nieuw Bericht
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                @forelse($messages as $message)
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    @if($message->sender_id === Auth::id())
                                        <strong>Aan:</strong> {{ $message->receiver->name }}
                                    @else
                                        <strong>Van:</strong> {{ $message->sender->name }}
                                    @endif
                                    <div class="text-muted small">
                                        {{ $message->created_at->format('d-m-Y H:i') }}
                                        @if($message->sender_id !== Auth::id() && !$message->is_read)
                                            <span class="badge bg-danger">Nieuw</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('messages.show', $message) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Bekijk
                                    </a>
                                    @if(Auth::id() === $message->sender_id)
                                        <form method="POST" action="{{ route('messages.destroy', $message) }}" class="d-inline"
                                              onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-2">{{ Str::limit($message->content, 100) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Geen berichten. <a href="{{ route('messages.create') }}">Stuur een bericht!</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
