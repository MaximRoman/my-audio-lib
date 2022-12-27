@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Добавьте новую книгу :</h3>
            <form class="form-group row justify-content-center gap-3" action={{ route('createBook') }} method="POST">
                @csrf
                <div class="col-7 d-flex flex-column align-items-start gap-2">
                    <label >Обложка</label>
                    @if (isset($image))
                        @foreach ($image as $item)
                            <img class="img-fluid" src="{{ asset('/storage/' . $item->image) }}">
                        @endforeach
                        <a class="btn btn-warning" href="/add-book/select-image"><i class="fa-solid fa-pen"></i></a>             
                    @else
                        <a class="btn btn-success" href="/add-book/select-image"><i class="fa-solid fa-plus"></i></a>
                    @endif        
                </div>
                <div class="col-7">
                    <label for="title">Название</label>
                    <input class="form-control bg-secondary text-light @error('title') is-invalid @enderror" type="text" name="title" id="title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-7 d-flex flex-column align-items-start">
                    <label for="authors">Автор</label>
                    @if (isset($authors))
                        @if (count($authors) > 0)
                            <div class="d-flex flex-warp mw-100 gap-1">
                                @foreach ($authors as $key => $item)
                                    <span class="h4 text-success">{{ $item->author }}</span>
                                    @if ($key < count($authors) - 1)
                                        <span class="h4">/</span>
                                    @endif                              
                                @endforeach
                            </div>
                            <a class="btn btn-warning" id="authors" href="/add-book/select-author"><i class="fa-solid fa-pen"></i></a>
                        @else
                        <a class="btn btn-success" id="authors" href="/add-book/select-author"><i class="fa-solid fa-plus"></i></a>
                        @endif
                    @endif
                </div>
                <div class="col-7 d-flex flex-column align-items-start">
                    <label for="readers">Читает</label>
                    @if (isset($readers))
                        @if (count($readers) > 0)
                            <div class="d-flex flex-warp mw-100">
                                @foreach ($readers as $item)
                                    <span>{{ $item->reader }} /</span>
                                @endforeach
                            </div>
                            <a class="btn btn-warning" id="readers" href="/add-book/select-reader"><i class="fa-solid fa-pen"></i></a>
                        @else
                            <a class="btn btn-success" id="readers" href="/add-book/select-reader"><i class="fa-solid fa-plus"></i></a>
                        @endif
                    @endif
                </div>
                <div class="col-7">
                    <label for="year">Год издания</label>
                    <input class="form-control bg-secondary text-light @error('year') is-invalid @enderror" type="number" name="year" id="year">
                    @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-7 d-flex flex-column align-items-start">
                    <label for="series">Цыкл</label>
                    <select class="w-100 form-select bg-secondary text-light" name="series" id="series">
                        @if (isset($series))
                            @foreach ($series as $item)
                                <option value="{{$item->id}}">{{ $item->series }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="d-flex gap-2 mt-2">
                        <a class="btn btn-warning" href="/edit-series"><i class="fa-solid fa-pen"></i></a>
                        <a class="btn btn-success" href="/add-book/add-series"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-7 d-flex flex-column align-items-start">
                    <label for="categories">Категория</label>
                    <div class="d-flex flex-warp mw-100">
                        @if (isset($categories))
                            @foreach ($categories as $item)
                                <span>{{ $item->category }} /</span>
                            @endforeach
                        @endif
                    </div>
                    <a class="btn btn-success" id="categories" href="/add-book/select-category"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="col-7">
                    <label for="description">Описание</label>
                    <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-7">
                    <label>Аудио Файлы Книги</label>
                    <multy-upload ></multy-upload>
                </div>
                <button type="submit" class="col-6 btn btn-success">Далее</button>
            </form>
        </div>
    </div>
@endsection
