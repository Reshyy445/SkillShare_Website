@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Post Detail -->
                <div class="post-detail">
                    <div class="d-flex gap-3">
                        <!-- Vote buttons -->
                        <div class="vote-buttons">
                            <button class="vote-button" onclick="vote('post', {{ $post->id }}, 'up')">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                            <span class="vote-count" id="post-vote-count">{{ $post->likes_count }}</span>
                            <button class="vote-button" onclick="vote('post', {{ $post->id }}, 'down')">
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </div>

                        <div class="flex-grow-1">
                            <div class="post-meta mb-3">
                                <span class="badge bg-orange">{{ ucfirst($post->type) }}</span>
                                <span>Posted by <a href="{{ route('users.show', $post->user) }}" class="text-orange">{{ $post->user->name }}</a></span>
                                <span class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</span>
                                <span class="text-muted">in <a href="{{ route('subjects.show', $post->subject) }}">{{ $post->subject->name }}</a></span>
                            </div>

                            <h1 class="display-6 fw-bold">{{ $post->title }}</h1>

                            <div class="post-content mt-4">
                                {!! nl2br(e($post->content)) !!}
                            </div>

                            <div class="post-actions mt-4 d-flex gap-3">
                                <button class="btn btn-outline-orange" onclick="toggleBookmark({{ $post->id }})">
                                    <i class="fas fa-bookmark" id="bookmark-icon-{{ $post->id }}"></i>
                                    <span id="bookmark-text-{{ $post->id }}">
                                    {{ $post->is_bookmarked ? 'Bookmarked' : 'Bookmark' }}
                                </span>
                                </button>

                                @if(Auth::id() === $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mt-4">
                    <h4>Comments ({{ $post->comments->count() }})</h4>

                    <!-- Best Answer (if exists) -->
                    @if($post->best_comment_id)
                        <div class="card border-success mb-3">
                            <div class="card-header bg-success text-white">
                                <i class="fas fa-check-circle"></i> Best Answer
                            </div>
                            <div class="card-body">
                                @include('comments.partials.comment', ['comment' => $post->bestComment])
                            </div>
                        </div>
                    @endif

                    <!-- All Comments -->
                    @foreach($post->comments as $comment)
                        @if($comment->id !== $post->best_comment_id)
                            @include('comments.partials.comment', ['comment' => $comment])
                        @endif
                    @endforeach

                    <!-- Add Comment Form -->
                    @auth
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="content" class="form-control" placeholder="Write a comment..." required>
                                <button type="submit" class="btn btn-orange">
                                    <i class="fas fa-paper-plane"></i> Comment
                                </button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function toggleBookmark(postId) {
                fetch(`/bookmarks/${postId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        const icon = document.getElementById(`bookmark-icon-${postId}`);
                        const text = document.getElementById(`bookmark-text-${postId}`);
                        if (data.bookmarked) {
                            icon.style.color = '#ff6b00';
                            text.textContent = 'Bookmarked';
                        } else {
                            icon.style.color = 'initial';
                            text.textContent = 'Bookmark';
                        }
                    });
            }

            function vote(type, id, direction) {
                // Implement vote logic
            }
        </script>
    @endsection
@endsection
