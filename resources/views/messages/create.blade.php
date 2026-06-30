@extends('layouts.app')

@section('title', 'Nieuw Bericht')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> Nieuw Bericht</h5>
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

                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="receiver_id" class="form-label">Ontvanger *</label>
                                <select class="form-control" id="receiver_id" name="receiver_id" required>
                                    <option value="">Kies een ontvanger...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Bericht *</label>
                                <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuleren
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Versturen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
