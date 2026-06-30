@extends('layouts.app')

@section('title', 'Vakken')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Vakken</h2>
            <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nieuw Vak
            </a>
        </div>

        <!-- Search Bar (Aesthetic only) -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Zoek naar vakken..." disabled>
                    <button class="btn btn-primary" disabled>
                        <i class="fas fa-search"></i> Zoek
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($subjects as $subject)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('subjects.show', $subject) }}" class="text-decoration-none">
                                    {{ $subject->name }}
                                </a>
                            </h5>
                            @if($subject->education)
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-graduation-cap"></i> {{ $subject->education }}
                                        @if($subject->level)
                                            - {{ $subject->level }}
                                        @endif
                                    </small>
                                </p>
                            @endif
                            <p class="card-text">
                                <small class="text-muted">
                                    Aangemaakt door {{ $subject->creator->name }}
                                </small>
                            </p>
                            <p class="card-text">
                                <span class="badge bg-secondary">{{ $subject->posts->count() }} berichten</span>
                            </p>
                            @if(Auth::id() === $subject->created_by || Auth::user()->isAdmin())
                                <div class="btn-group">
                                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('subjects.destroy', $subject) }}"
                                          onsubmit="return confirm('Weet je zeker dat je dit vak wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Geen vakken gevonden. <a href="{{ route('subjects.create') }}">Maak het eerste vak aan!</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
