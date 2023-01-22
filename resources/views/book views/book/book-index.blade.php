@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column-reverse">
        <div class="card bg-gray border-success mb-3 border-0" >
            <div class="card-body row justify-content-start">
                <div class="mb-3">
                    <edit-delete-btns class="d-flex justify-content-between" :book="{{$book->id}}" :admin-prop="{{json_encode($admin)}}"></edit-delete-btns>
                    <h4 class="text-center">{{ $book->title }} </h4>
                    
                </div>
                <div class="col-md-auto col-12  d-flex justify-content-center">
                    @foreach ($images as $image)
                        @if ($book->id === $image->book_id)
                            <img class="h-300px" src="{{ 'https://laravelmyaudiolib.s3.amazonaws.com/' . $image->image }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-8 col-md-6 d-flex flex-column justify-content-between gap-3">
                    <div>
                        <div class="m-0">
                            <span class="h5 me-2">Автор:</span>
                            @foreach ($authors as $author)
                                @if ($book->id === $author->book_id)
                                    <a class="my-link h5 text-success" href="/search/{{$author->author}}/">{{ $author->author }}</a>
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <span class="h5 me-2">Читает:</span>
                            @foreach ($readers as $reader)
                                @if ($book->id === $reader->book_id)
                                    <a class="my-link h5 text-success" href="/search/{{$reader->reader}}/">{{ $reader->reader }}</a>
                                    <span class="h5 me-2">,</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <span class="h5 me-2">Год:</span>
                            <span class="h5 text-primary">{{ $book->year }}</span>
                        </div>
                        <div class="mt-3">
                            <span class="h5 me-2">Длительность:</span>
                            @foreach ($duration as $item)
                                @if ($book->id === $item->book_id)
                                    <audio-duration class="h5 text-primary" :duration-value="{{$item->duration}}"></audio-duration>
                                @endif
                            @endforeach
                        </div>
                        {{-- <div class="mt-3">
                            <span class="h5 me-2">Цыкл:</span>
                            @foreach ($series as $seriesItem)
                                @if ($book->id === $seriesItem->book_id)
                                    <span class="h5 text-success">{{ $seriesItem->series }}</span>
                                    @break
                                @endif
                            @endforeach
                        </div> --}}
                        <div class="mt-3">
                            <span class="h5 me-2">Категория:</span>
                            @foreach ($categories as $category)
                                @if ($book->id === $category->book_id)
                                <a class="my-link h5 text-success" href="/category/{{$category->temp_category}}/">{{ $category->category }}</a>
                                <span class="h5 me-1 ms-1">,</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                        <span class="h5 me-2">Описание:</span>
                        <p>{{$book->description}}</p>
                </div>
                
                <div class="mt-3 d-flex justify-content-between">
                    <add-to-fav :book="{{$book->id}}" :fav-prop="{{json_encode($fav)}}" :user-id="{{$userId}}"></add-to-fav>
                    <like-book :book="{{json_encode($book)}}" :user="{{json_encode($user)}}" :btn="{{json_encode(true)}}"></like-book>
                </div>
                <audio-player class="mt-5" :file="{{ $files }}"></audio-player>
                <comments-system class="mt-5" :book="{{$book->id}}" :user="{{$user}}"></comments-system>
            </div>
        </div>
    </div>
@endsection
