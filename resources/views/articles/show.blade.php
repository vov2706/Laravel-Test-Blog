@extends('layouts.home')

@section('content')
    <div class="article-show-content col-md-5 mx-auto mt-5 mb-5">
        @if ($article)
            <div class="breadcrumbs">
                {{ Breadcrumbs::render('article', $article) }}
            </div>       
            <h1 class="">{{ $article->title }}</h1>
            <p class="text-muted" style="font-size: 1.2em">{{ $article->created_at->format('Y-m-d, h:i') }}</p>
            <p><img src="/images/{{ $article->image->max }}" alt="Article image" class="col-md-8 float-left m-1">
                {!! $article->description !!}
            </p>
            <div class="w-75 d-flex justify-content-between position-absolute mx-auto mt-3" style="height: 50px; bottom: 0; left: 15%;">
                @if(isset($prevArticle))
                    <a href="/articles/{{ $prevArticle }}" class="float-left">Попередня стаття</a>
                @endif
                @if(isset($nextArticle))
                    <a href="/articles/{{ $nextArticle }}" class="float-right">Наступна стаття</a>
                @endif
            </div>
        @endif
    </div>
@endsection