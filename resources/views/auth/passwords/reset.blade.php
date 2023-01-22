@extends('layouts.app')

@section('content')
    <div class="card rounded-0 h-100 bg-gray border-0">
        <div class="card-body">
            <h3 class="text-center">Сброс пароля:</h3>
            <br>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Эл. адрес') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control bg-secondary text-light @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control bg-secondary text-light @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Подтвердить Пароль') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control bg-secondary text-light" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Сбросить пароля') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
