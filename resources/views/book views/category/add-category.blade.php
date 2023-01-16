@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Добавить новую Категорию :</h3>
            <div class="h3 d-flex justify-content-between">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-category"><i class="fa-solid fa-arrow-left"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book/select-category"><i class="fa-solid fa-arrow-left"></i></a>
                @endif
            </div>
            <form class="form-group row justify-content-center gap-3" action={{ route('createCategory') }} method="POST">
                @csrf
                <input type="hidden" name="bookId" value="{{$bookId}}">
                <div class="col-7">
                    <label for="category">Категория</label>
                    <input class="form-control bg-secondary text-light @error('category') is-invalid @enderror" type="text" name="category" id="category">
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-7">
                    <label for="temp_category">Категория - temp</label>
                    <input class="form-control bg-secondary text-light @error('temp_category') is-invalid @enderror" type="text" name="temp_category" id="temp_category">
                    @error('temp_category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="col-6 btn btn-success" type="submit">Добавить</button>
            </form>
        </div>
    </div>
@endsection
