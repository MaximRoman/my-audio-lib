@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Добавьте новую книгу :</h3>
            <form class="form-group row justify-content-center" action={{ route('createBook') }} method="POST">
                @csrf
                <div class="col-4 h-100 p-0 m-0">
                    <div class="d-flex flex-column align-items-start gap-2">
                        <label>Обложка</label>
                        @if (isset($image))
                            @if (count($image) > 0)
                                <div class="row">
                                    <div class="col-12">
                                        @foreach ($image as $item)
                                            <img class="img-fluid rounded-top" src="{{'https://laravelmyaudiolib.s3.amazonaws.com/' . $item->image }}">
                                        @endforeach
                                        <a class="btn btn-warning w-100 rounded-0 rounded-bottom" href="/add-book/select-image"><i class="fa-solid fa-pen"></i></a>    
                                    </div>
                                </div>
                            @else
                                <a class="btn btn-success" href="/add-book/select-image"><i class="fa-solid fa-plus"></i></a>    
                            @endif   
                        @endif        
                    </div>
                </div>
                <div class="col-8 row justify-content-start  p-0 m-0">
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Название</label>
                        @if (isset($title))
                            @if (count($title) > 0)
                                <div>
                                    @foreach ($title as $item)
                                        <span class="h4 text-success">{{ $item }}</span>                
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-title"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/add-book/select-title"><i class="fa-solid fa-plus"></i></a>
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
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-author"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/add-book/select-author"><i class="fa-solid fa-plus"></i></a>
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
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-reader"><i class="fa-solid fa-pen"></i></a>
                                </div>
                           @else
                                <a class="btn btn-success" href="/add-book/select-reader"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 d-flex flex-column align-items-start">
                        <label>Год</label>
                        @if (isset($year))
                            @if (count($year) > 0)
                                <div>
                                    @foreach ($year as $item)
                                        <span class="h4 text-success">{{ $item }}</span>                
                                    @endforeach
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-year"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                            <a class="btn btn-success" href="/add-book/select-year"><i class="fa-solid fa-plus"></i></a>
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
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-series"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                            <a class="btn btn-success" href="/add-book/select-series"><i class="fa-solid fa-plus"></i></a>
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
                                    <a class="btn btn-warning ms-2 h4" href="/add-book/select-category"><i class="fa-solid fa-pen"></i></a>
                                </div>
                            @else
                                <a class="btn btn-success" href="/add-book/select-category"><i class="fa-solid fa-plus"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-12 p-0 m-0 mt-3">
                    
                    @if (isset($description))
                        @if (count($description) > 0)
                            <label class="w-100 d-flex justify-content-between align-items-center mb-1"><span>Описание</span> <a class="btn btn-warning" href="/add-book/select-description"><i class="fa-solid fa-pen"></i></a></label>
                            @foreach ($description as $item)
                                <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" disabled>{{ $item }}</textarea>
                            @endforeach
                        @else
                            <label class="w-100 d-flex justify-content-between align-items-center mb-1"><span>Описание</span> <a class="btn btn-success" href="/add-book/select-description"><i class="fa-solid fa-plus"></i></a></label>
                            <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" disabled></textarea>
                        @endif
                    @endif
                    
                </div>
                {{-- <div class="col-12 mt-3">
                    <label>Аудио Файлы Книги</label>
                    <multy-upload card="bg-secondary text-light" childs="bg-gray text-light"></multy-upload>
                </div> --}}
                <button type="submit" class="col-6 btn btn-success mt-3" style="display: {{ $validate ? 'block': 'none'; }}">Далее</button>
            </form>
        </div>
    </div>
@endsection
