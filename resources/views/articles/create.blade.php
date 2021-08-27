@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="content-header-title">Створення статті</h1>
    @if ($errors->any() || isset($errorTags))
        <div class="alert alert-danger" style="font-size: 1.6em"> 
            <ul>
                @if(isset($errorTags))
                    <li>Ви не можете додати тег(и) - {{ implode(', ', $errorTags) }}, так як вони не є унікальними.</li>
                @endif
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('content')
    <form action="{{ isset($article->id) ? route('articles.update', ['article' => $article]) : route('articles.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="title" 
                class="form-control form-elem w-25" 
                id="title" 
                name="title"
                value="{{ isset($article->title) ? $article->title : old('title') }}"
                placeholder="Введіть заголовок статті"
                required
                autofocus
            >
        </div>
        <div class="form-group">
            <label for="image">Фото для статті</label>
            <input type="file" 
                class="form-control-file" 
                id="image"
                name="image"
            >

            @if(isset($article->image))
                <div class="form-group">
                    
                    <label>
                        <span class="label">Зображення матеріалу:</span>
                    </label>
                    
                    <img src="/images/{{ json_decode($article->image)->path }}">
                    <input type="hidden" name="old_image" value="{{$article->image}}">

                </в>
            @endif

        </div>
        <div class="form-group">
            <label for="tags">Теги(розділяти комою ', ')</label>
            <input type="title" 
                class="form-control form-elem w-50" 
                id="tags" 
                name="tags"
                placeholder="спорт,політика,forbes"
                value="{{ isset($tags) ? implode(', ', $tags) : old('tags') }}"
            >
            @if(isset($tags))
                <div class="mt-3">
                    Теги статті: {{ implode(', ', $tags) }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Текст статті</label>
            <textarea class="form-control form-elem w-25" 
                id="description" 
                name="description"
                rows="3"
                value="{{ old('description') }}"
            >
            {{ isset($article->description) ? $article->description : old('description')}}
            </textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" 
                class="form-check-input" 
                id="is_active" 
                name="is_active"
                value="1" 
                {{ isset($article->is_active) && $article->is_active == 1 ? 'checked="checked"' : '' }}>
            <label class="form-check-label ml-2" for="is_active">Активна новина</label>
        </div>
        @if(isset($article->id))
            <input type="hidden" name="_method" value="PUT">		    
        @endif
        @csrf
        <button type="submit" class="btn btn-primary mt-3">Зберегти</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    
@stop
