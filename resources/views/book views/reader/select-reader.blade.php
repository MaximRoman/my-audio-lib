@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Читателей Книги : </h3>
            <div class="h3 d-flex justify-content-between gap-3">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}/add-reader"><i class="fa-solid fa-plus"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-book/add-reader"><i class="fa-solid fa-plus"></i></a>
                @endif
            </div>
            @if (isset($readers))
                <list-item  class="mt-3"
                    list-name="Список Читателей :" 
                    :items="{{json_encode($readers)}}" 
                    name-input="reader" 
                    type-input="checkbox" 
                    empty-message="Нет Читателей в Базе" 
                    url="/add-book/select-book-reader">
                </list-item>
                @if (isset($bookId))
                    <form class="row justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-reader" method="POST">
                        @csrf
                @else
                    <form class="row justify-content-center mt-3" action="/add-book">
                @endif
                    <button class="btn btn-success col-6" type="submit">Выбрать</button>
                </form>
            @endif
        </div>
    </div>
@endsection
