@extends('layouts.app')

@section('title', 'Bericht Bewerken')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Bericht Bewerken</h5>
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

                        <form method="POST" action="{{ route('posts.update', $post) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Titel *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title', $post->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Type *</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="explanation" {{ old('type', $post->type) == 'explanation' ? 'selected' : '' }}>Uitleg</option>
                                    <option value="summary" {{ old('type', $post->type) == 'summary' ? 'selected' : '' }}>Samenvatting</option>
                                    <option value="blog" {{ old('type', $post->type) == 'blog' ? 'selected' : '' }}>Blog</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Inhoud *</label>
                                <textarea class="form-control" id="content" name="content" rows="8" required>{{ old('content', $post->content) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('subjects.show', $post->subject) }}" class="btn btn-secondary">
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
