@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Описание Книги :</h3>
            <div class="h3 d-flex justify-content-between">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
                @endif
            </div>            
            @if (isset($bookId))
                <form class="row gap-3 justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-description" method="POST">
            @else
                <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookDescription') }} method="POST">
            @endif
                @csrf
                <div class="col-10">
                    <label for="description">Описание</label>
                    <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="col-6 btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
                        