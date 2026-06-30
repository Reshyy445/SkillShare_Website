@extends('layouts.app')

@section('title', 'Mijn Profiel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Mijn Profiel</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if($profile->profile_picture)
                                <img src="{{ asset('storage/' . $profile->profile_picture) }}"
                                     alt="Profielfoto"
                                     class="rounded-circle"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center"
                                     style="width: 150px; height: 150px;">
                                    <i class="fas fa-user fa-5x text-white"></i>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Naam:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Opleiding:</strong> {{ $profile->education ?? 'Niet ingevuld' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Niveau:</strong> {{ $profile->level ?? 'Niet ingevuld' }}</p>
                                <p><strong>School:</strong> {{ $profile->school ?? 'Niet ingevuld' }}</p>
                                <p><strong>Lid sinds:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                            </div>
                        </div>

                        @if($profile->bio)
                            <div class="mt-3">
                                <h6>Bio</h6>
                                <p>{{ $profile->bio }}</p>
                            </div>
                        @endif

                        <div class="text-center mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Profiel Bewerken
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
