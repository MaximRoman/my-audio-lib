@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Год издания Книги :</h3>
            @if (isset($bookId))
                <a class="btn btn-success" href="/edit-book/{{$bookId}}"><i class="fa-solid fa-arrow-left"></i></a>
            @else
                <a class="btn btn-success" href="/add-book"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
            @if (isset($bookId))
                <form class="row gap-3 justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-year" method="POST">
            @else
                <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookYear') }} method="POST">
            @endif
                @csrf
                <div class="col-7">
                    <label for="year">Год</label>
                    <input class="form-control bg-secondary text-light @error('year') is-invalid @enderror" type="number" name="year" id="year">
                    @error('year')
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
                        