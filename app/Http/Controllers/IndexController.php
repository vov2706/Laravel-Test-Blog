<?php

namespace App\Http\Controllers;

use App\Models\Article;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::where('is_active', 1)
            ->with('tags')    
            ->latest()
            ->paginate(10);

        return view('home.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        if($article) {
            $article->image = json_decode($article->image);
        }

        $articles = Article::where('is_active', 1)->latest()->pluck('id')->toArray();

        $articleKey = array_search($id, $articles);
        $prevArticle = $articleKey != 0 ? $articles[$articleKey-1] : null;
        $nextArticle = $articleKey != (count($articles) - 1) ? $articles[$articleKey+1] : null;

        return view('articles.show', compact('article', 'prevArticle', 'nextArticle'));
    }
}
