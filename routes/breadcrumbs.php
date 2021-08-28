<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Головна', route('home'));
});

//Home > [Article]
Breadcrumbs::for('article', function ($trail, $article) {
    $trail->parent('home');
    $trail->push($article->title, route('articles.show', $article->id));
});
