@extends('layouts.home')

@section('content')
    <div class="article-show-content col-md-5 mx-auto mt-5 mb-5">
        @if ($article)
            <div class="breadcrumbs">
                {{ Breadcrumbs::render('article', $article) }}
            </div>       
            <h1 class="">{{ $article->title }}</h1>
            <p class="text-muted" style="font-size: 1.2em">{{ $article->created_at->format('Y-m-d, h:i') }}</p>
            <p><img src="/images/{{ $article->image }}" alt="Article image" class="col-md-8 float-left m-1">
                {!! $article->description !!}
            </p>
        @endif
    </div>
@endsection