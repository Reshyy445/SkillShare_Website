@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Welkom, {{ Auth::user()->name }}!</h5>
                        <div class="list-group mt-3">
                            <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-user"></i> Mijn Profiel
                            </a>
                            <a href="{{ route('subjects.index') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-book"></i> Vakken
                            </a>
                            <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-envelope"></i> Berichten
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-warning">
                                    <i class="fas fa-user-cog"></i> Admin Panel
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Recente Berichten</h5>
                    </div>
                    <div class="card-body">
                        @forelse($recentPosts as $post)
                            <div class="border-bottom py-3">
                                <h6>
                                    <a href="{{ route('subjects.show', $post->subject) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h6>
                                <p class="text-muted small">
                                    Geplaatst door {{ $post->user->name }} in
                                    {{ $post->subject->name }} | {{ $post->created_at->diffForHumans() }}
                                </p>
                                <p>{{ Str::limit($post->content, 150) }}</p>
                            </div>
                        @empty
                            <p class="text-muted">Geen recente berichten.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
