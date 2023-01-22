@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Редактировать Данные Книги :</h3>
            <form class="form-group row justify-content-center" action="/">
                <div class="col-4 h-100 p-0 m-0">
                    <div class="d-flex flex-column align-items-start gap-2">
                        <label>Обложка</label>
                        @if (isset($image))
                            @if (count($image) > 0)
                                <div class="row">
                                    <div class="col-12">
                                        @foreach ($image as $item)
                                            <img class="img-fluid rounded-top" src="{{ 'https://laravelmyaudiolib.s3.amazonaws.com/' . $item->image }}">
                                        @endforeach
                                        <a class="btn btn-warning w-100 rounded-0 rounded-bottom" href="/edit-book/{{$bookId}}/select-image"><i class="fa-solid fa-pen"></i></a>    
                                    </div>
                                </div>
                            @else
                                <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-image"><i class="fa-solid fa-plus"></i></a>    
                            @endif   
                        @endif        
                    </div>
                </div>
                <div class="col-8 row justify-content-start  p-0 m-0">
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Название</label>
                        @if (isset($book))
                            @if (count($book) > 0)
                                <div>
                                    @foreach ($book as $item)
                                        <span class="h4 text-success">{{ $item->title }}</span>                
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-title"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-title"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Автор</label>
                        @if (isset($authors))
                            @if (count($authors) > 0)
                                <div>
                                    @foreach ($authors as $item)
                                        <span class="h4 text-success">{{ $item->author }}</span>
                                        @if ($loop->index < count($authors) - 1)
                                            <span class="h4 me-2">,</span>
                                        @endif                              
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-author"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-author"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Читает</label>
                        @if (isset($readers))
                            @if (count($readers) > 0)
                                <div>
                                    @foreach ($readers as $item)
                                        <span class="h4 w-100 text-success">{{ $item->reader }}</span>
                                        @if ($loop->index < count($readers) - 1)
                                            <span class="h4 me-2">,</span>
                                        @endif                              
                                    @endforeach 
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-reader"><i class="fa-solid fa-pen"></i></a>
                                </div>
                           @else
                                <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-reader"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Год</label>
                        @if (isset($book))
                            @if (count($book) > 0)
                                <div>
                                    @foreach ($book as $item)
                                        <span class="h4 text-success">{{ $item->year }}</span>                
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-year"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                            <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-year"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                    {{-- <div class="col-12 d-flex flex-column align-items-start">
                        <label>Цыкл</label>
                        @if (isset($series))
                            @if (count($series) > 0)
                                <div class="d-flex flex-warp mw-100 gap-1">
                                    @foreach ($series as $item)
                                        <span class="h4 text-success">{{ $item->series }}</span>
                                        @if ($loop->index < count($series) - 1)
                                            <span class="h4 me-1 ms-1">/</span>
                                        @endif                              
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-series"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                            <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-series"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div> --}}
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Категория</label>
                        @if (isset($categories))
                            @if (count($categories) > 0)
                                <div>
                                    @foreach ($categories as $item)
                                        <span class="h4 text-success">{{ $item->category }}</span>
                                        @if ($loop->index < count($categories) - 1)
                                            <span class="h4 me-1 ms-1">/</span>
                                        @endif                              
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/edit-book/{{$bookId}}/select-category"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-category"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-12 p-0 m-0 mt-3">
                    
                    @if (isset($book))
                        @if (count($book) > 0)
                            <label class="w-100 d-flex justify-content-between align-items-center mb-1"><span>Описание</span> <a class="btn btn-warning" href="/edit-book/{{$bookId}}/select-description"><i class="fa-solid fa-pen"></i></a></label>
                            @foreach ($book as $item)
                                <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" disabled>{{ $item->description }}</textarea>
                            @endforeach
                        @else
                            <label class="w-100 d-flex justify-content-between align-items-center mb-1"><span>Описание</span> <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-description"><i class="fa-solid fa-plus"></i></a></label>
                            <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" disabled></textarea>
                        @endif
                    @endif
                    
                </div>
                <a class="btn btn-warning mt-3" href="/edit-book/{{$bookId}}/upload-files">Изменить Аудио файлы Книги</a>
                <button type="submit" class="col-6 btn btn-success mt-3">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
