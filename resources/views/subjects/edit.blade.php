@extends('layouts.app')

@section('title', 'Vak Bewerken')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Vak Bewerken</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('subjects.update', $subject) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Vaknaam *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $subject->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="education" class="form-label">Opleiding</label>
                                <input type="text" class="form-control" id="education" name="education"
                                       value="{{ old('education', $subject->education) }}">
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Niveau</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="">Kies...</option>
                                    <option value="Bachelor" {{ old('level', $subject->level) == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                    <option value="Master" {{ old('level', $subject->level) == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="PhD" {{ old('level', $subject->level) == 'PhD' ? 'selected' : '' }}>PhD</option>
                                    <option value="HBO" {{ old('level', $subject->level) == 'HBO' ? 'selected' : '' }}>HBO</option>
                                    <option value="WO" {{ old('level', $subject->level) == 'WO' ? 'selected' : '' }}>WO</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuleren
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Bijwerken
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
