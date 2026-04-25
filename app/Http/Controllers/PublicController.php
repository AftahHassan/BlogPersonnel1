<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Liste des articles publiés
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc');

        // Filtre par catégorie
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Bonus : recherche par titre
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(6);

        return view('public.index', compact('articles', 'categories'));
    }

    // Détail d'un article
    public function show(Article $article)
    {
        // Bloquer les brouillons aux visiteurs
        if ($article->status !== 'published') {
            abort(404);
        }

        return view('public.show', compact('article'));
    }
}