@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Категорий Книги : </h3>
            <div class="h3 d-flex justify-content-between gap-3">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                    {{-- <a class="btn btn-success" href="/edit-book/{{$bookId}}/add-category"><i class="fa-solid fa-plus"></i></a> --}}
                @else
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                    {{-- <a class="btn btn-success" href="/add-book/add-category"><i class="fa-solid fa-plus"></i></a> --}}
                @endif
            </div>
            @if (isset($categories))
                <list-item  class="mt-3"
                    list-name="Список Категорий :" 
                    :items="{{json_encode($categories)}}" 
                    name-input="category" 
                    type-input="checkbox" 
                    empty-message="Нет Авторов в Базе" 
                    url="/add-book/select-book-category">
                </list-item>
                @if (isset($bookId))
                    <form class="row justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-category" method="POST">
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
