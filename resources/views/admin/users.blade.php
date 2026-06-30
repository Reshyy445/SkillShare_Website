@extends('layouts.app')

@section('title', 'Beheer Gebruikers')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Beheer Gebruikers</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Terug
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Opleiding</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->isAdmin())
                                        <span class="badge bg-warning">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">Gebruiker</span>
                                    @endif
                                </td>
                                <td>{{ $user->profile->education ?? '-' }}</td>
                                <td>
                                    @if($user->id !== Auth::id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                              onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Verwijder
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Jijzelf</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
