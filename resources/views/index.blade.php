@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column">
        @forelse ($books as $item)
        <form id="book-{{$item->id}}" action="/book/{{$item->id}}"></form>
        <div class="card bg-gray border-success mb-3">
            <div class="card-header border-success">
                <div class="row align-items-center">
                    <add-to-fav :book="{{$item->id}}"></add-to-fav>
                    <h4 class="col-8 text-center"  style="cursor: pointer;"  onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">{{ $item->title }} </h4>
                    <edit-delete-btns class="col-2" :book="{{$item->id}}"></edit-delete-btns>
                </div>
            </div>
            <div class="card-body row">
                <div class="col-4">
                    @foreach ($images as $image)
                        @if ($item->id === $image->book_id)
                            <img class="img-fluid" src="{{ 'https://laravelmyaudiolib.s3.amazonaws.com/' . $image->image }}"  style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">
                        @endif
                    @endforeach
                </div>
                <div class="col-8">
                    <div class="m-0">
                        <span class="h5 me-2">Автор :</span>
                        @foreach ($authors as $author)
                            @if ($item->id === $author->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$author->author}}">{{ $author->author }}</a>
                                @if ($loop->index < count($authors) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Читает :</span>
                        @foreach ($readers as $reader)
                            @if ($item->id === $reader->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$reader->reader}}">{{ $reader->reader }}</a>
                                @if ($loop->index < count($readers) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Год :</span>
                        <span class="h5 text-primary">{{ $item->year }}</span>
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Цыкл :</span>
                        @foreach ($series as $seriesItem)
                            @if ($item->id === $seriesItem->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$seriesItem->series}}">{{ $seriesItem->series }}</a>
                                {{-- <span class="h5 text-light">( {{ count($series) }} )</span> --}}
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Категория :</span>
                        @foreach ($categories as $category)
                            @if ($item->id === $category->book_id)
                                <a class="my-link h5 text-success" href="/{{$category->temp_category}}/">{{ $category->category }}</a>
                                <span class="h5 me-1 ms-1">/</span>
                                {{-- @if ($loop->index > 1)
                                @endif --}}
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Описание :</span>
                        <p  style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">
                            @foreach (explode(' ', $item->description) as $str)
                                @if ($loop->index < 30)
                                    {{ $str }}
                                @endif
                            @endforeach
                            ....
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer border-success d-flex justify-content-between">
                <like-book :book="{{json_encode($item)}}" :user="{{json_encode($user)}}" :btn="{{json_encode(true)}}"></like-book>
                {{-- <div class="d-flex gap-2">
                    <a class="btn btn-outline-success" href="/set-book-grade/{{$item->id}}/1"><i class="fa-regular fa-thumbs-up"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-thumbs-down"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-comment"></i> {{ 0 }}</a>
                </div> --}}
                <button class="btn btn-success" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">Подробнее</button>
            </div>
        </div>
        @empty
            @if (isset($message))
                <div class="card bg-gray border-success mb-3">
                    <div class="card-body">
                        <p class="h3 text-center text-danger">{{$message}}</p>
                    </div>
                </div>
            @else 
                <h3 class="text-center text-danger">! Нет книг в базе !</h3>
            @endif
        @endforelse
    </div>
@endsection
