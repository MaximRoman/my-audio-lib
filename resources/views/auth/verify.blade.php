@extends('layouts.app')

@section('content')
    <div class="card rounded-0 bg-gray h-100 border-0">
        <div class="card-body">
            <h3 class="text-center">Проверьте свой адрес электронной почты:</h3>
            <br>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            {{ __('Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.') }}
            {{ __('Если вы не получили письмо') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь, чтобы запросить ссылку ещё раз') }}</button>.
            </form>
        </div>
    </div>
@endsection
