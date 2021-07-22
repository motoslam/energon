@extends('layouts.guest')
@section('pagetitle', 'Авторизация')

@section('content')
    <div class="container">
        <div class="title-form">Авторизация</div>
        <form class="form-serv" action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-item">
                <label for="email">Электронная почта</label>
                <input type="email" required id="email" name="email"
                       class="@error('email') error @enderror"
                       value="{{ old('email') }}" autocomplete="email"
                       autofocus />
            </div>
            <div class="form-item">
                <a href="javascript:void(0);" class="pass-show" tabindex="-1"></a>
                <label for="password">Пароль</label>
                <input id="password" type="password"
                       class="@error('password') error @enderror"
                       name="password" required autocomplete="current-password">
            </div>
            <button id="submit" class="btn-blue" type="submit">Войти</button>
            @if (Route::has('password.request'))
                <a class="foget-pass" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif
        </form>

        @if ($errors->any())
            <div class="message-form message-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

    </div>
@endsection
