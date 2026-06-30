@extends('layouts.app')

@section('title', 'Beheer Berichten')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Beheer Berichten</h2>
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
                            <th>Titel</th>
                            <th>Type</th>
                            <th>Gebruiker</th>
                            <th>Vak</th>
                            <th>Datum</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ Str::limit($post->title, 30) }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($post->type) }}</span></td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->subject->name }}</td>
                                <td>{{ $post->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                          onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
