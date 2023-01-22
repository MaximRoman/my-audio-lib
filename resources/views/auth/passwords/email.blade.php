@extends('layouts.app')

@section('content')
    <div class="card rounded-0 h-100 bg-gray border-0">
        <h3 class="text-center">Сброс пароля:</h3>
        <br>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Эл. адрес') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control bg-secondary text-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Отправить ссылку для сброса пароля') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
