@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column-reverse">
        <div class="card bg-gray border-success mb-3 border-0" >
            <div class="card-body row">
                <div class="mb-3 d-flex">
                    <h4 class="text-center w-100">{{ $book->title }}</h4>
                    <div class="d-flex gap-2">
                        <form action="/edit-book/{{ $book->id }}">
                            <button class="btn btn-warning h4" type="submit"><i class="fa-solid fa-pen"></i></button>
                        </form>
                        <form action='/delete-book/{{ $book->id }}' method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger h4" type="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-4">
                    @foreach ($images as $image)
                        @if ($book->id === $image->book_id)
                            <img class="img-fluid" src="{{ asset('/storage/' . $image->image) }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-8">
                    <div class="m-0">
                        <span class="h5 me-2">Автор :</span>
                        @foreach ($authors as $author)
                            @if ($book->id === $author->book_id)
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
                            @if ($book->id === $reader->book_id)
                                <span class="h5 text-success">{{ $reader->reader }}</span>
                                @if ($loop->index < count($readers) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Год :</span>
                        <span class="h5 text-primary">{{ $book->year }}</span>
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Длительность :</span>
                        <audio-duration class="h5 text-primary" :obj="{{$duration}}"></audio-duration>
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Оценка :</span>
                        <span class="h5 text-primary">{{ 0 }} / {{10}}</span>
                        @forelse ($grades as $item)
                            {{$item}}
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Цыкл :</span>
                        @foreach ($series as $seriesItem)
                            @if ($book->id === $seriesItem->book_id)
                                <span class="h5 text-success">{{ $seriesItem->series }}</span>
                                {{-- <span class="h5 text-light">( {{ count($series) }} )</span> --}}
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Категория :</span>
                        @foreach ($categories as $category)
                            @if ($book->id === $category->book_id)
                                <span class="h5 text-success">{{ $category->category }}</span>
                                @if ($loop->index < count($categories) - 1)
                                    <span class="h5 me-1 ms-1">/</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    
                </div>
                <div class="mt-3">
                        <span class="h5 me-2">Описание :</span>
                        <p>{{$book->description}}</p>
                    </div>
                <audio-player class="mt-5" :file="{{ $files }}"></audio-player>
            </div>
        </div>
    </div>
@endsection
