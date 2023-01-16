@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Загрузка новой Обложки :</h3>
            <div class="h3 d-flex justify-content-between">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-image"><i class="fa-solid fa-arrow-left"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book/select-image"><i class="fa-solid fa-arrow-left"></i></a>
                @endif
            </div>
            <form class="form-group row justify-content-center gap-3" action={{ route('uploadImage') }} method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="bookId" value="{{$bookId}}">
                <div class="col-7">
                    <label for="name">Название</label>
                    <input class="form-control bg-secondary text-light @error('name') is-invalid @enderror" type="text" name="name" id="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-7">
                    <label for="image">Изображение</label>
                    <input class="form-control bg-secondary text-light @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="col-6 btn btn-success">Добавить</button>
            </form>
        </div>
    </div>
@endsection
