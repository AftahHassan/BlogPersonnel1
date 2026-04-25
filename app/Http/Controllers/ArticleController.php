<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Tableau de bord — tous les articles
    public function index()
    {
        $articles = Article::with('category')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('articles.index', compact('articles'));
    }

    // Formulaire création
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    // Sauvegarder un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id'      => auth()->id(),
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'content'      => $request->content,
            'image'        => $imagePath,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Article créé avec succès !');
    }

    // Formulaire modification
    public function edit(Article $article)
    {
        // Vérifier que l'article appartient au blogueur connecté
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    // Mettre à jour un article
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Nouvelle image uploadée
        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'content'      => $request->content,
            'image'        => $imagePath,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' 
                                ? ($article->published_at ?? now()) 
                                : null,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Article modifié avec succès !');
    }

    // Supprimer un article
    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        // Supprimer l'image du storage
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Article supprimé avec succès !');
    }
}