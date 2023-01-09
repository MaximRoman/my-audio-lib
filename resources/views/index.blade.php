@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column-reverse">
        @forelse ($data['books'] as $item)
        <form id="book-{{$item->id}}" action="/book/{{$item->id}}"></form>
        <div class="card bg-gray border-success mb-3">
            <div class="card-header d-flex justify-content-between align-items-center border-success">
                <h4 class="text-center w-100"  style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">{{ $item->title }}</h4>
                <div class="d-flex gap-2">
                    <form action="/edit-book/{{ $item->id }}">
                        <button class="btn btn-warning h4" type="submit"><i class="fa-solid fa-pen"></i></button>
                    </form>
                    <form action='/delete-book/{{ $item->id }}' method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger h4" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-body row">
                <div class="col-4">
                    @foreach ($data['images'] as $image)
                        @if ($item->id === $image->book_id)
                            <img class="img-fluid" src="{{ asset('/storage/' . $image->image) }}"  style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">
                        @endif
                    @endforeach
                </div>
                <div class="col-8">
                    <div class="m-0">
                        <span class="h5 me-2">Автор :</span>
                        @foreach ($data['authors'] as $author)
                            @if ($item->id === $author->book_id)
                                <a class="my-link h5 text-success" href="/">{{ $author->author }}</a>
                                @if ($loop->index < count($data['authors']) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Читает :</span>
                        @foreach ($data['readers'] as $reader)
                            @if ($item->id === $reader->book_id)
                                <a class="my-link h5 text-success" href="/">{{ $reader->reader }}</a>
                                @if ($loop->index < count($data['readers']) - 1)
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
                        @foreach ($data['series'] as $seriesItem)
                            @if ($item->id === $seriesItem->book_id)
                                <a class="my-link h5 text-success" href="/">{{ $seriesItem->series }}</a>
                                {{-- <span class="h5 text-light">( {{ count($series) }} )</span> --}}
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Категория :</span>
                        @foreach ($data['categories'] as $category)
                            @if ($item->id === $category->book_id)
                                <a class="my-link h5 text-success" href="/">{{ $category->category }}</a>
                                @if ($loop->index < count($data['categories']) - 1)
                                    <span class="h5 me-1 ms-1">/</span>
                                @endif
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
                <like-book :book="{{json_encode($item)}}" :user="{{json_encode($data['user'])}}"></like-book>
                {{-- <div class="d-flex gap-2">
                    <a class="btn btn-outline-success" href="/set-book-grade/{{$item->id}}/1"><i class="fa-regular fa-thumbs-up"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-thumbs-down"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-comment"></i> {{ 0 }}</a>
                </div> --}}
                <button class="btn btn-success" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">Подробнее</button>
            </div>
        </div>
        @empty
            <h3 class="text-center">Нет книг в базе, <a href="/add-book">добавить новую книгу</a></h3>
        @endforelse
    </div>
@endsection
