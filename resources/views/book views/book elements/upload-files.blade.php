@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Загрузка Аудио Файлов Книги :</h3>
            <div class="h3 d-flex justify-content-between">
                <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <multy-upload card='bg-secondary text-light' childs='bg-gray text-light' :obj="{{$book}}"></multy-upload>
        </div>
    </div>
@endsection
