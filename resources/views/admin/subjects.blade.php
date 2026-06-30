@extends('layouts.app')

@section('title', 'Beheer Vakken')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Beheer Vakken</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Terug
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Opleiding</th>
                            <th>Niveau</th>
                            <th>Aangemaakt door</th>
                            <th>Aantal berichten</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->education ?? '-' }}</td>
                                <td>{{ $subject->level ?? '-' }}</td>
                                <td>{{ $subject->creator->name }}</td>
                                <td>{{ $subject->posts->count() }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}"
                                          onsubmit="return confirm('Weet je zeker dat je dit vak wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Verwijder
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $subjects->links() }}
            </div>
        </div>
    </div>
@endsection
