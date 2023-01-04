@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор обложки книги :</h3>
            @if (isset($bookId))
                <div class="h3 d-flex justify-content-between">
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-image"><i class="fa-solid fa-plus"></i></a>
                </div>
            @else
                <div class="h3 d-flex justify-content-between">
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                    <a class="btn btn-success" href="/add-image"><i class="fa-solid fa-plus"></i></a>
                </div>
            @endif
            @if (isset($images))
                <div class="row gap-3 justify-content-center mt-3">
                    @foreach ($images as $item)
                        @if (isset($bookId))
                            <form id="image-{{$item->id}}" class="col-3" action="/edit-book/{{$bookId}}/select-book-image/{{ $item->id }}" method="POST">
                        @else
                            <form id="image-{{$item->id}}" class="col-3" action="/add-book/select-image/{{ $item->id }}" method="POST">
                        @endif
                            @csrf
                            <a class="btn btn-warning w-100 rounded-0 rounded-top" href="/edit-image/{{$item->id}}"><i class="fa-solid fa-gear"></i></a>
                            <img class=" img-fluid" src="{{ asset('/storage/' . $item->image) }}" >
                            <button class="btn btn-success w-100 rounded-0 rounded-bottom" type="submit">Выбрать</button>
                        </form>           
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
