@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Загрузка новой Обложки :</h3>
            @if (!isset($path))
                <form id="image-upload-form" class="form-group row justify-content-center gap-3" action={{ route('uploadImage') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-7">
                        <label for="image">Обложка книги</label>
                        <input class="form-control bg-secondary text-light @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image" oninput="document.getElementById('image-upload-form').submit()">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            @endif
            @isset($path)
                <div class="row mt-3 justify-content-center">
                    <img class="col-6 img-fluid" src="{{ asset('/storage/' . $path) }}" alt="">
                </div>
                <div class="row mt-3 justify-content-center">
                    <a class="col-6 btn btn-success" href="/add-book">Далее</a>
                </div>
            @endisset
        </div>
    </div>
@endsection
