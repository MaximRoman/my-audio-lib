@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Изменить Информацыю о книге :</h3>
            <div class="row justify-content-center gap-3">
                <a class="col-7 btn btn-success" href={{ route('editBookInfo') }}>Изменить Название, Год или Описание Книги</a>
                <a class="col-7 btn btn-success" href={{ route('editBookImage') }}>Изменить Обложку Книги</a>
                <a class="col-7 btn btn-success" href={{ route('editBookAuthors') }}>Изменить список Авторов Книги</a>
                <a class="col-7 btn btn-success" href={{ route('editBookReaders') }}>Изменить список Читателей Книги</a>
                <a class="col-7 btn btn-success" href={{ route('editBookCategories') }}>Изменить список Категорий Книги</a>
                <a class="col-7 btn btn-success" href={{ route('editBookFiles') }}>Изменить Аудио Файлы Книги</a>
            </div>
        </div>
    </div>
@endsection
