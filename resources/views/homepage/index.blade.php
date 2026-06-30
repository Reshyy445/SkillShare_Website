@extends('layouts.app')

@section('title', 'SkillShare - Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center py-5">
                        <h1 class="display-4 text-primary">Welkom bij SkillShare</h1>
                        <p class="lead mt-3">Deel kennis, help anderen en leer samen!</p>
                        <div class="mt-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-arrow-right"></i> Ga naar Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                                    <i class="fas fa-user-plus"></i> Start Nu
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-sign-in-alt"></i> Inloggen
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
