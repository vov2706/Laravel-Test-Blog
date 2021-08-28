@extends('adminlte::page')

@section('title', 'Панель керування')

@section('content_header')
    <h1 style="font-size: 3rem;">Панель керування</h1>
@stop

@section('content')
    <div class="w-25 p-3 bg-light d-flex flex-column align-items-left">
        <p class="float-left" style="font-size: 2.6em;">З поверненням, {{ auth()->user()->name }}!</p>
        <a href="{{ route('home') }}" style="font-size: 2em;">
            <p class="text-info">Повернутися на головну ></p>
        </a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
@stop
