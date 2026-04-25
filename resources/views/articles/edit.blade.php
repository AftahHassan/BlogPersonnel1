@extends('layouts.app')

@section('content')

<div class="form-container">
    <h1 class="page-title">Modifier l'article</h1>

    <form method="POST" action="{{ route('articles.update', $article) }}"
          enctype="multipart/form-data" class="article-form">
        @csrf
        @method('PUT')

        <!-- Titre -->
        <div class="form-group">
            <label class="form-label">Titre *</label>
            <input type="text"
                   name="title"
                   class="form-input {{ $errors->has('title') ? 'input-error' : '' }}"
                   value="{{ old('title', $article->title) }}"
                   placeholder="Titre de l'article">
            @error('title')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Catégorie -->
        <div class="form-group">
            <label class="form-label">Catégorie *</label>
            <select name="category_id"
                    class="form-select {{ $errors->has('category_id') ? 'input-error' : '' }}">
                <option value="">-- Choisir une catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contenu -->
        <div class="form-group">
            <label class="form-label">Contenu *</label>
            <textarea name="content"
                      class="form-textarea {{ $errors->has('content') ? 'input-error' : '' }}"
                      rows="10">{{ old('content', $article->content) }}</textarea>
            @error('content')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image actuelle -->
        @if($article->image)
            <div class="form-group">
                <label class="form-label">Image actuelle</label>
                <div class="current-image">
                    <img src="{{ Storage::url($article->image) }}"
                         alt="Image actuelle">
                </div>
            </div>
        @endif

        <!-- Nouvelle image -->
        <div class="form-group">
            <label class="form-label">
                {{ $article->image ? 'Changer l\'image' : 'Ajouter une image' }}
            </label>
            <input type="file"
                   name="image"
                   class="form-file"
                   accept="image/*">
            @error('image')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Statut -->
        <div class="form-group">
            <label class="form-label">Statut *</label>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="status" value="draft"
                           {{ old('status', $article->status) === 'draft' ? 'checked' : '' }}>
                    Brouillon
                </label>
                <label class="radio-label">
                    <input type="radio" name="status" value="published"
                           {{ old('status', $article->status) === 'published' ? 'checked' : '' }}>
                    Publier
                </label>
            </div>
        </div>

        <!-- Boutons -->
        <div class="form-actions">
            <a href="{{ route('dashboard') }}" class="btn-secondary">Annuler</a>
            <button type="submit" class="btn-primary">💾 Mettre à jour</button>
        </div>

    </form>
</div>

@endsection