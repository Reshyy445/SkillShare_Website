@extends('layouts.app')

@section('title', 'SkillShare - Deel Kennis, Help Studenten')

@section('content')
    <!-- Hero Section met Oranje Achtergrond -->
    <div class="hero-section bg-orange text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-3 fw-bold mb-4">The Heart of Student Knowledge</h1>
                    <p class="lead mb-4">
                        SkillShare is home to thousands of student communities, endless knowledge sharing,
                        and authentic academic connection. Whether you're into math, programming, economics,
                        or any other subject, there's a community on SkillShare for you.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                        <i class="fas fa-graduation-cap"></i> Join SkillShare
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">How does SkillShare work?</h2>
            <p class="lead text-muted">
                Every day, thousands of students around the world post, vote, and comment in communities
                organized around their studies.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-orange text-white mx-auto mb-3">
                            <i class="fas fa-pen fa-3x"></i>
                        </div>
                        <h4 class="fw-bold">Post</h4>
                        <p class="text-muted">
                            The community can share content by posting explanations, summaries, and study materials.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-orange text-white mx-auto mb-3">
                            <i class="fas fa-comment fa-3x"></i>
                        </div>
                        <h4 class="fw-bold">Comment</h4>
                        <p class="text-muted">
                            The community comments on posts. Comments provide discussion, feedback, and often helpful insights.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-orange text-white mx-auto mb-3">
                            <i class="fas fa-thumbs-up fa-3x"></i>
                        </div>
                        <h4 class="fw-bold">Vote</h4>
                        <p class="text-muted">
                            Comments & posts can be upvoted or downvoted. The most helpful content rises to the top.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">SkillShare by the numbers</h2>
                <p class="lead text-muted">
                    SkillShare is a growing family of students sharing the knowledge they care about most.
                </p>
            </div>

            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3 class="display-4 fw-bold text-orange">{{ $stats['daily_active'] ?? '0' }}</h3>
                        <p class="text-muted">Daily Active Students</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3 class="display-4 fw-bold text-orange">{{ $stats['weekly_active'] ?? '0' }}</h3>
                        <p class="text-muted">Weekly Active Students</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3 class="display-4 fw-bold text-orange">{{ $stats['subjects'] ?? '0' }}</h3>
                        <p class="text-muted">Active Subjects</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <h3 class="display-4 fw-bold text-orange">{{ $stats['posts'] ?? '0' }}</h3>
                        <p class="text-muted">Posts & Comments</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-5 fw-bold">SkillShare News</h2>
            <a href="{{ route('news') }}" class="btn btn-outline-orange">View more →</a>
        </div>

        <div class="row g-4">
            @foreach($news as $item)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge bg-orange mb-2">{{ $item['date'] }}</span>
                            <h5 class="fw-bold">{{ $item['title'] }}</h5>
                            <p class="text-muted">{{ $item['excerpt'] }}</p>
                            <a href="#" class="text-orange text-decoration-none">Read more →</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
