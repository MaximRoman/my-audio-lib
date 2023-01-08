@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Добавить нового Автора :</h3>
            <form class="form-group row justify-content-center gap-3" action={{ route('createAuthor') }} method="POST">
                @csrf
                <div class="col-7">
                    <label for="author">Автор</label>
                    <input class="form-control bg-secondary text-light @error('author') is-invalid @enderror" type="text" name="author" id="author">
                    @error('author')
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
