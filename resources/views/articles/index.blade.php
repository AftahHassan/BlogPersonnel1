@extends('layouts.app')

@section('content')

<div class="dashboard-header">
    <h1 class="page-title">Tableau de bord</h1>
    <a href="{{ route('articles.create') }}" class="btn-primary">
        + Nouvel article
    </a>
</div>

@if($articles->isEmpty())
    <div class="empty-state">
        <p>Vous n'avez pas encore d'articles.</p>
        <a href="{{ route('articles.create') }}" class="btn-primary">Créer mon premier article</a>
    </div>
@else
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            @if($article->image)
                                <img src="{{ Storage::url($article->image) }}"
                                     alt="" class="table-thumbnail">
                            @else
                                <span class="no-image">—</span>
                            @endif
                        </td>
                        <td class="table-title">{{ $article->title }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            <span class="badge {{ $article->status === 'published' ? 'badge-published' : 'badge-draft' }}">
                                {{ $article->status === 'published' ? 'Publié' : 'Brouillon' }}
                            </span>
                        </td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td class="table-actions">
                            <a href="{{ route('articles.edit', $article) }}"
                               class="btn-edit">✏️ Modifier</a>

                            <form method="POST"
                                  action="{{ route('articles.destroy', $article) }}"
                                  onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection