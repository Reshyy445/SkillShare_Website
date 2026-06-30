@extends('layouts.app')

@section('title', 'Profiel Bewerken')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Profiel Bewerken</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="text-center mb-4">
                                @if($profile->profile_picture)
                                    <img src="{{ asset('storage/' . $profile->profile_picture) }}"
                                         alt="Profielfoto"
                                         class="rounded-circle mb-2"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-2"
                                         style="width: 150px; height: 150px;">
                                        <i class="fas fa-user fa-5x text-white"></i>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profielfoto</label>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                                    <small class="text-muted">Maximaal 2MB (jpeg, png, jpg, gif)</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Naam *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $profile->bio) }}</textarea>
                            </div>

                            <hr>

                            <h6 class="mb-3">Onderwijsgegevens</h6>

                            <div class="mb-3">
                                <label for="education" class="form-label">Opleiding</label>
                                <input type="text" class="form-control" id="education" name="education"
                                       value="{{ old('education', $profile->education) }}">
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Niveau</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="">Kies...</option>
                                    <option value="Bachelor" {{ old('level', $profile->level) == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                    <option value="Master" {{ old('level', $profile->level) == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="PhD" {{ old('level', $profile->level) == 'PhD' ? 'selected' : '' }}>PhD</option>
                                    <option value="HBO" {{ old('level', $profile->level) == 'HBO' ? 'selected' : '' }}>HBO</option>
                                    <option value="WO" {{ old('level', $profile->level) == 'WO' ? 'selected' : '' }}>WO</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="school" class="form-label">School</label>
                                <input type="text" class="form-control" id="school" name="school"
                                       value="{{ old('school', $profile->school) }}">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuleren
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Opslaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
