<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index()
    {
        // On récupère tous les articles, du plus récent au plus vieux.
        $articles = Article::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // 1. Récupérer les données valides (excepté l'image)
        // $data = $request->all();
        // $data = $request->safe()->only(['title', 'content']);
        $data = $request->safe()->except(['image']);

        // 2. Gestion de l'image si présente
        if ($request->hasFile('image')) {
            // Stocke dans storage/app/public/articles
            $path = $request->file('image')->store('articles', 'public');
            // Ajoute le chemin de l'image aux données à sauvegarder
            $data['image_path'] = $path;
        }

        // 3. Création de l'article via le relation.
        // Cela remplit automiquement le user_id avec l'ID de l'utilisateur authentifié.
        $article = $request->user()->articles()->create($data);

        // 4. Redirection vers la liste des articles avec un message de succès
        return redirect()->route('articles.index')
                        ->with('success', 'Article créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
