@extends('layouts.app')

@section('title', $user->name . ' - Profiel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if($user->profile->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                 alt="{{ $user->name }}"
                                 class="rounded-circle mb-3"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-5x text-white"></i>
                            </div>
                        @endif

                        <h4>{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>

                        @if($user->profile->bio)
                            <p class="mt-3">{{ $user->profile->bio }}</p>
                        @endif

                        <hr>

                        <div class="row text-center">
                            <div class="col-6">
                                <h5>{{ $stats['total_posts'] }}</h5>
                                <small class="text-muted">Posts</small>
                            </div>
                            <div class="col-6">
                                <h5>{{ $stats['total_comments'] }}</h5>
                                <small class="text-muted">Comments</small>
                            </div>
                        </div>

                        <div class="row text-center mt-2">
                            <div class="col-6">
                                <h5>{{ $stats['total_likes_received'] }}</h5>
                                <small class="text-muted">Likes</small>
                            </div>
                            <div class="col-6">
                                <h5>{{ $stats['achievements_count'] }}</h5>
                                <small class="text-muted">Achievements</small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">Lid sinds: {{ $stats['member_since'] }}</small>
                        </div>

                        @if(Auth::id() !== $user->id)
                            <div class="mt-3">
                                <a href="{{ route('messages.create', ['receiver_id' => $user->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> Stuur Bericht
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($user->achievements->count() > 0)
                    <div class="card shadow-sm mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">Achievements</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($user->achievements as $achievement)
                                    <span class="badge bg-warning text-dark p-2" title="{{ $achievement->description }}">
                                    <i class="{{ $achievement->icon }}"></i> {{ $achievement->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">
                            <i class="fas fa-file-alt"></i> Posts ({{ $posts->total() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab">
                            <i class="fas fa-comments"></i> Comments ({{ $comments->total() }})
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="profileTabsContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel">
                        @forelse($posts as $post)
                            <div class="card mb-2 shadow-sm">
                                <div class="card-body">
                                    <h6>
                                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </h6>
                                    <p class="small text-muted">
                                        in <a href="{{ route('subjects.show', $post->subject) }}">{{ $post->subject->name }}</a>
                                        • {{ $post->created_at->diffForHumans() }}
                                        • <i class="fas fa-heart text-danger"></i> {{ $post->likes_count }}
                                    </p>
                                    <p>{{ Str::limit($post->content, 100) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                {{ $user->name }} heeft nog geen posts geplaatst.
                            </div>
                        @endforelse

                        {{ $posts->links() }}
                    </div>

                    <div class="tab-pane fade" id="comments" role="tabpanel">
                        @forelse($comments as $comment)
                            <div class="card mb-2 shadow-sm">
                                <div class="card-body">
                                    <p>{{ $comment->content }}</p>
                                    <p class="small text-muted">
                                        Op <a href="{{ route('posts.show', $comment->post) }}">{{ $comment->post->title }}</a>
                                        • {{ $comment->created_at->diffForHumans() }}
                                        • <i class="fas fa-heart text-danger"></i> {{ $comment->likes_count }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                {{ $user->name }} heeft nog geen comments geplaatst.
                            </div>
                        @endforelse

                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
