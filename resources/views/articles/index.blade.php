@extends('adminlte::page')

@section('title', 'Ваші статті')

@section('content_header')
    <h1 class="content-header-title">Статті</h1>
@stop

@section('content')
    <table id="articles" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Фото</th>
                <th>Заголовок</th>
                <th>Дата створення</th>
                <th>Активність</th>
                <th>Редагувати</th>
                <th>Видалити</th>
            </tr>
        </thead>
        @if($articles)
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="/images/{{ $article->image }}"
                                alt="Article image"
                                width="100"
                                height="75"
                            />
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at->format('Y-m-d, h:i') }}</td>
                        <td>{!! $article->is_active ? '<i class="fas fa-check"></i>' : '<i class="far fa-times-circle"></i>'!!}</td>
                        <td>
                            <a href="{{ route('articles.edit', ['article' => $article]) }}">
                                <btn class="btn btn-primary"> Редагувати </btn>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('articles.destroy', ['article' => $article]) }}">
                                <btn class="btn btn-danger"> Видалити </btn>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#articles').DataTable();
        } );
    </script>    
@stop
