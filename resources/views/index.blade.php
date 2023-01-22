@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column">
        @forelse ($books as $item)
        <form id="book-{{$item->id}}" action="/book/{{$item->id}}"></form>
        <div class="card bg-gray border-success mb-3">
            <div class="card-header border-success">
                <div class="row w-100 align-items-center justify-content-center">
                    <h4 class="m-0 p-0 text-center"  style="cursor: pointer;"  onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">{{ $item->title }} </h4>
                </div>
            </div>
            <div class="card-body row justify-content-start">
                <div class="col-md-auto col-12 d-flex justify-content-center">
                    @foreach ($images as $image)
                        @if ($item->id === $image->book_id)
                            <img src="{{ 'https://laravelmyaudiolib.s3.amazonaws.com/' . $image->image }}"  style="cursor: pointer; height: 300px; width: 200px;" onclick="event.preventDefault(); document.getElementById('book-{{$item->id}}').submit();">
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="m-0">
                        <span class="h5 me-2">Автор:</span>
                        @foreach ($authors as $author)
                            @if ($item->id === $author->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$author->author}}/">{{ $author->author }}</a>
                                @if ($loop->index < count($authors) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Читает:</span>
                        @foreach ($readers as $reader)
                            @if ($item->id === $reader->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$reader->reader}}/">{{ $reader->reader }}</a>
                                @if ($loop->index < count($readers) - 1)
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Длительность:</span>
                        @foreach ($duration as $durationItem)
                            @if ($item->id === $durationItem->book_id)
                                <audio-duration class="h5 text-primary" :duration-value="{{$durationItem->duration}}"></audio-duration>
                            @endif
                        @endforeach
                    </div>
                    {{-- <div class="mt-3">
                        <span class="h5 me-2">Цыкл :</span>
                        @foreach ($series as $seriesItem)
                            @if ($item->id === $seriesItem->book_id)
                                <a class="my-link h5 text-success" href="/search/{{$seriesItem->series}}">{{ $seriesItem->series }}</a>
                                @break
                            @endif
                        @endforeach
                    </div> --}}
                    <div class="mt-3">
                        <span class="h5 me-2">Категория:</span>
                        @foreach ($categories as $category)
                            @if ($item->id === $category->book_id)
                                <a class="my-link h5 text-success" href="/category/{{$category->temp_category}}/">{{ $category->category }}</a>
                                <span class="h5 me-1 ms-1">/</span>
                                {{-- @if ($loop->index > 1)
                                @endif --}}
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="h5 me-2">Описание:</span>
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
        @if ($totalPages > 1)
            <div class="d-flex justify-content-between mt-5">   
                <div class="d-flex col-2">                    
                    @if ($page == 1)
                        <button class="w-100 btn btn-outline-success" type="submit" @disabled(true)><i class="fa-solid fa-arrow-left"></i></button>
                    @else
                        <a class="w-100 btn btn-outline-success d-flex align-items-center justify-content-center" href="/{{$link}}page/{{$page - 1}}"><i class="fa-solid fa-arrow-left"></i></a>
                    @endif 
                </div>
                <div class="d-flex gap-2">
                    {{-- @for ($i = 0; $i < $totalPages; $i++)
                        @if ($i + 1 == $page)
                            <button class="btn btn-success rounded-circle">{{$i + 1}}</button>
                        @else
                            <a class="btn btn-outline-success rounded-circle" href="/{{$link}}page/{{$i + 1}}">{{$i + 1}}</a>
                        @endif
                    @endfor --}}
                    <h3 class="text-success">{{$page}} / {{$totalPages}}</h3>
                </div>
                <div class="d-flex gap-2 col-2">
                    @if($page == $totalPages)
                        <button class="w-100 btn btn-outline-success" type="submit" @disabled(true)><i class="fa-solid fa-arrow-right"></i></button>
                    @else
                        <a class="w-100 btn btn-outline-success d-flex align-items-center justify-content-center" href="/{{$link}}page/{{$page + 1}}"><i class="fa-solid fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
