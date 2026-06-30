@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h2>Admin Panel</h2>
                <p class="text-muted">Welkom, {{ Auth::user()->name }}! Beheer hier alle content.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white shadow-sm">
                    <div class="card-body">
                        <h5>{{ $usersCount }}</h5>
                        <p class="mb-0">Gebruikers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body">
                        <h5>{{ $postsCount }}</h5>
                        <p class="mb-0">Berichten</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white shadow-sm">
                    <div class="card-body">
                        <h5>{{ $subjectsCount }}</h5>
                        <p class="mb-0">Vakken</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark shadow-sm">
                    <div class="card-body">
                        <h5>{{ $commentsCount }}</h5>
                        <p class="mb-0">Reacties</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5>Beheer Opties</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 mb-2">
                                    <i class="fas fa-users"></i> Beheer Gebruikers
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.posts') }}" class="btn btn-outline-success w-100 mb-2">
                                    <i class="fas fa-file-alt"></i> Beheer Berichten
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.subjects') }}" class="btn btn-outline-info w-100 mb-2">
                                    <i class="fas fa-book"></i> Beheer Vakken
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.comments') }}" class="btn btn-outline-warning w-100 mb-2">
                                    <i class="fas fa-comments"></i> Beheer Reacties
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
