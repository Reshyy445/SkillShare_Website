@extends('layouts.app')

@section('title', $subject->name)

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>{{ $subject->name }}</h2>
                @if($subject->education)
                    <p class="text-muted">
                        <i class="fas fa-graduation-cap"></i> {{ $subject->education }}
                        @if($subject->level)
                            - {{ $subject->level }}
                        @endif
                    </p>
                @endif
            </div>
            <a href="{{ route('posts.create', $subject) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nieuw Bericht
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                @forelse($subject->posts as $post)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5>{{ $post->title }}</h5>
                            <div class="text-muted small mb-2">
                                <i class="fas fa-user"></i> {{ $post->user->name }}
                                <span class="mx-2">•</span>
                                <i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d-m-Y H:i') }}
                                <span class="badge bg-info">{{ ucfirst($post->type) }}</span>
                            </div>
                            <p>{{ Str::limit($post->content, 200) }}</p>

                            @if(Auth::id() === $post->user_id || Auth::user()->isAdmin())
                                <div class="btn-group">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Bewerk
                                    </a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                          onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Verwijder
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <hr>
                            <h6 class="mb-3">Reacties ({{ $post->comments->count() }})</h6>

                            @foreach($post->comments as $comment)
                                <div class="border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>{{ $comment->user->name }}</strong>
                                            <span class="text-muted small">- {{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if(Auth::id() === $comment->user_id || Auth::user()->isAdmin())
                                            <div>
                                                <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="d-inline"
                                                      onsubmit="return confirm('Weet je zeker dat je deze reactie wilt verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mb-1">{{ $comment->content }}</p>
                                </div>
                            @endforeach

                            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-3">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="content" class="form-control" placeholder="Schrijf een reactie..." required>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Reageer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Geen berichten in dit vak. <a href="{{ route('posts.create', $subject) }}">Plaats het eerste bericht!</a>
                    </div>
                @endforelse
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Over dit vak</h6>
                        <p class="text-muted small">
                            <i class="fas fa-user"></i> Aangemaakt door {{ $subject->creator->name }}
                        </p>
                        <p class="text-muted small">
                            <i class="fas fa-file-alt"></i> {{ $subject->posts->count() }} berichten
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
