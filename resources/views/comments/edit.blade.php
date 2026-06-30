@extends('layouts.app')

@section('title', 'Reactie Bewerken')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Reactie Bewerken</h5>
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

                        <form method="POST" action="{{ route('comments.update', $comment) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="content" class="form-label">Reactie *</label>
                                <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $comment->content) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('subjects.show', $comment->post->subject) }}" class="btn btn-secondary">
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
