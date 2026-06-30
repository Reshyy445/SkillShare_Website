@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-plus"></i> Registreren</h4>
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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Naam *</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email adres *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Wachtwoord *</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Bevestig wachtwoord *</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3">Profielgegevens (optioneel)</h6>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="education" class="form-label">Opleiding</label>
                                    <input type="text" class="form-control" id="education" name="education"
                                           value="{{ old('education') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="level" class="form-label">Niveau</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="">Kies...</option>
                                        <option value="Bachelor" {{ old('level') == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                        <option value="Master" {{ old('level') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="PhD" {{ old('level') == 'PhD' ? 'selected' : '' }}>PhD</option>
                                        <option value="HBO" {{ old('level') == 'HBO' ? 'selected' : '' }}>HBO</option>
                                        <option value="WO" {{ old('level') == 'WO' ? 'selected' : '' }}>WO</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="school" class="form-label">School</label>
                                    <input type="text" class="form-control" id="school" name="school"
                                           value="{{ old('school') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus"></i> Registreren
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>Heb je al een account? <a href="{{ route('login') }}">Log hier in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
