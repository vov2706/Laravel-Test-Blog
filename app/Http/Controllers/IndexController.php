<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('articles.show', compact('article'));
    }
}
