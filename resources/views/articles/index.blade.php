@extends('adminlte::page')

@section('title', 'Ваші статті')

@section('content_header')
    <h1 class="content-header-title">Статті</h1>
@stop

@section('content')
    <!-- Start modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" style="font-size: 2em;" id="exampleModalLongTitle">Видалення статті</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size:1.8em;">
                    Ви впевнені, що хочете видалити цю статтю?
                </div>
                <div class="modal-footer" style="font-size:1.4em;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Відмінити</button>
                    <form action="/dashboard/articles" method="POST" id="deleteForm">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-primary">Видалити</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->

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
                            <img src="/images/{{ json_decode($article->image)->mini }}"
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
                            <button class="btn btn-danger delete" id="deleteBtn" value="{{ $article->id }}">Видалити</button>
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
            var table = $('#articles').DataTable();

            var deleteBtns = $('.delete')
                deleteBtns.each(function(index, btn) {
                    $(btn).on("click",function () { 
                        console.log(btn.value)
                        $('#deleteForm').attr('action', `/dashboard/articles/${btn.value}`)
                        $('#modal').modal('show');
                    })
                })
        });
    </script>  
@stop
