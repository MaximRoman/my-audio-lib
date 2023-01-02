@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Описание Книги :</h3>
            <form class="form-group row justify-content-center gap-3" action={{ route('selectBookDescription') }} method="POST">
                @csrf
                <div class="col-7">
                    <label for="description">Описание</label>
                    <textarea class="form-control bg-secondary text-light @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10"></textarea>
                    @error('description')
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
                        