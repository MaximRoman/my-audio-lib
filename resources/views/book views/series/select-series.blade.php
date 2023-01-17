@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Цыкла Книги : </h3>
            <div class="h3 d-flex justify-content-between gap-3">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}/add-series"><i class="fa-solid fa-plus"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-book/add-series"><i class="fa-solid fa-plus"></i></a>
                @endif
            </div>
            @if (isset($series))
                <list-item  class="mt-3"
                    list-name="Список Цыклов :" 
                    :items="{{json_encode($series)}}" 
                    name-input="series" 
                    type-input="radio" 
                    empty-message="Нет Цыклов Книг в Базе" 
                    url="/add-book/select-book-series">
                </list-item>
                @if (isset($bookId))
                    <form class="row justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-series" method="POST">
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
