@extends('layouts.app')

@section('content')

<div class="article-detail">

    <!-- Header article -->
    <div class="article-detail-header">
        <span class="card-category">{{ $article->category->name }}</span>
        <h1 class="article-detail-title">{{ $article->title }}</h1>
        <div class="article-detail-meta">
            <span>🗓 {{ $article->published_at->format('d/m/Y') }}</span>
            <span>✍️ {{ $article->user->name }}</span>
            <span>⏱ {{ ceil(str_word_count($article->content) / 200) }} min de lecture</span>
        </div>
    </div>

    <!-- Image -->
    @if($article->image)
        <div class="article-detail-image">
            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
        </div>
    @endif

    <!-- Contenu -->
    <div class="article-detail-content">
        {!! nl2br(e($article->content)) !!}
    </div>

    <!-- Retour -->
    <div class="article-detail-back">
        <a href="{{ route('articles.index') }}" class="btn-back">← Retour aux articles</a>
    </div>

</div>

@endsection