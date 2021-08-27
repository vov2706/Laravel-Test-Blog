@extends('layouts.home')

@section('content')
    <div class="content w-75 mx-auto mt-4">
        <h1 class="content-title mx-auto text-center">Останні новини</h1>
        <div class="d-flex flex-column mt-5">
            @if($articles)
                @foreach($articles as $article)
                    <div class="card mb-3 mx-auto" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img
                                    src="/images/{{json_decode($article->image)->path}}" 
                                    alt="Article image"
                                    class="img-fluid"
                                    width="350"
                                />
                            </div>
                            <!-- <p>{{gettype($article->image)}}</p> -->
                            <div class="col-md-7">
                                <div class="card-body float-left">
                                    <a href="{{ route('articles.show', ['article' => $article]) }}">
                                        <h5 class="card-title" style="font-size: 2em">{{ $article->title }}</h5>
                                    </a>
                                    <p class="card-text">
                                        <small class="text-muted" style="font-size: 1.2em">{{ $article->created_at->format('Y-m-d, h:i') }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3" style="font-size: 1.4em">
        <ul class="pagination">
            @if($articles->currentPage() !== 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $articles->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif
            @for($i = 1; $i <= $articles->lastPage(); $i++)
                    @if($articles->currentPage() == $i)
                        <li class="page-item active">
                            <a class="page-link" disabled">{{ $i }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
            @endfor
            @if($articles->currentPage() !== $articles->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $articles->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endsection