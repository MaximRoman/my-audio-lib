@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор обложки книги :</h3>
            <div class="h3 d-flex justify-content-between gap-3">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-image/{{$bookId}}"><i class="fa-solid fa-plus"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-image"><i class="fa-solid fa-plus"></i></a>
                @endif
            </div>
            @if (isset($images))
                @if (isset($bookId))
                <images-list :images="{{$images}}" url="/edit-book/{{$bookId}}/select-book-image/"></images-list>
                @else
                <images-list :images="{{$images}}" url="/add-book/select-book-image/"></images-list>
                @endif    
            @endif
            
        </div>
    </div>
@endsection
