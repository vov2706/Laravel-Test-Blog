@extends('adminlte::page')

@section('title', 'Додавання нової статті')

@section('content_header')
    <h1 class="content-header-title">Створення статті</h1>
@stop

@section('content')
    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="title" 
                class="form-control form-elem w-25" 
                id="title" 
                name="title"
                :value="isset($article->title) ? $article->title : old('title')"
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
        </div>
        <div class="form-group">
            <label for="description">Текст статті</label>
            <textarea class="form-control form-elem w-25" 
                id="description" 
                name="description"
                rows="3"
            >
            {{ isset($article->description) ? $article->description : old('description') }}
            </textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" 
                class="form-check-input" 
                id="is_active" 
                name="is_active"
                value="1" 
                {{ old('is_active') ? 'checked="checked"' : '' }}>
            <label class="form-check-label ml-2" for="is_active">Активність</label>
        </div>
        @csrf
        <button type="submit" class="btn btn-primary mt-3">Зберегти</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    
@stop
