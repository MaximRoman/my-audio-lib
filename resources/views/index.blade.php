@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column-reverse">
        @forelse ($books as $item)
        <div class="card bg-gray border-success mb-3">
            <div class="card-header d-flex justify-content-between align-items-center border-success">
                <h4 class="text-center w-100">{{ $item->title }}</h4>
                <div class="d-flex gap-2">
                    <a  href={{ route('editBook') }}></a>
                    <form action="{{ route('editBook') }}" method="GET">
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
                    @foreach ($images as $image)
                        @if ($item->id === $image->book_id)
                            <img class="img-fluid" src="{{ asset('/storage/' . $image->image) }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-8">
                    <div class="m-0">
                        <span class="h5 me-2">Автор :</span>
                        @foreach ($authors as $author)
                            @if ($item->id === $author->book_id)
                                <span class="h5 text-success">{{ $author->author }}</span>
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
                                <span class="h5 text-success">{{ $reader->reader }}</span>
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
                                <span class="h5 text-success">{{ $seriesItem->series }}</span>
                                {{-- <span class="h5 text-light">( {{ count($series) }} )</span> --}}
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Категория :</span>
                        @foreach ($categories as $category)
                            @if ($item->id === $category->book_id)
                                <span class="h5 text-success">{{ $category->category }}</span>
                                @if ($loop->index < count($categories) - 1)
                                    <span class="h5 me-1 ms-1">/</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Описание :</span>
                        <p>
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
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-thumbs-up"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-thumbs-down"></i> {{ 0 }}</a>
                    <a class="btn btn-outline-success" href=""><i class="fa-regular fa-comment"></i> {{ 0 }}</a>
                </div>
                <a class="btn btn-success" href="">Подробнее</a>
            </div>
        </div>
        @empty
            <h3 class="text-center">Нет книг в базе, <a href="/add-book">добавить новую книгу</a></h3>
        @endforelse
    </div>
@endsection
