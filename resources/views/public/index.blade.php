@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1 class="page-title">Tous les Articles</h1>
    <p class="page-subtitle">Découvrez mes dernières publications</p>
</div>

<!-- FILTRES -->
<div class="filters-container">

    <!-- Filtre par catégorie -->
    <div class="filter-categories">
        <a href="{{ route('articles.index') }}"
           class="filter-btn {{ !request('category') ? 'active' : '' }}">
            Toutes
        </a>
        @foreach($categories as $category)
            <a href="{{ route('articles.index', ['category' => $category->id]) }}"
               class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Recherche -->
    <form method="GET" action="{{ route('articles.index') }}" class="search-form">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text"
               name="search"
               class="search-input"
               placeholder="Rechercher un article..."
               value="{{ request('search') }}">
        <button type="submit" class="search-btn">🔍</button>
    </form>

</div>

<!-- LISTE DES ARTICLES -->
@if($articles->isEmpty())
    <div class="empty-state">
        <p>Aucun article trouvé.</p>
    </div>
@else
    <div class="articles-grid">
        @foreach($articles as $article)
            <div class="article-card">

                @if($article->image)
                    <div class="card-image">
                        <img src="{{ Storage::url($article->image) }}"
                             alt="{{ $article->title }}">
                    </div>
                @else
                    <div class="card-image card-image-placeholder">
                        📄
                    </div>
                @endif

                <div class="card-body">
                    <span class="card-category">{{ $article->category->name }}</span>
                    <h2 class="card-title">{{ $article->title }}</h2>
                    <p class="card-excerpt">
                        {{ Str::limit($article->content, 120) }}
                    </p>
                    <div class="card-footer">
                        <span class="card-date">
                            🗓 {{ $article->published_at->format('d/m/Y') }}
                        </span>
                        <a href="{{ route('articles.show', $article) }}"
                           class="btn-read">
                            Lire la suite →
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="pagination-container">
        {{ $articles->links() }}
    </div>
@endif

@endsection