@extends('layouts.guest')
@section('pagetitle', 'Регистрация')

@section('content')
    <div class="container">
        <div class="title-form">Регистрация</div>
        <form class="form-serv" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-item">
                <label for="name">Как вас зовут?</label>
                <input type="name" required id="name" name="name"
                       class="@error('name') error @enderror"
                       value="{{ old('name') }}" autocomplete="name"
                       autofocus />
            </div>
            <div class="form-item">
                <label for="email">Электронная почта</label>
                <input type="email" required id="email" name="email"
                       class="@error('email') error @enderror"
                       value="{{ old('email') }}" autocomplete="email"
                />
            </div>
            <div class="form-item">
                <a href="#" class="pass-show" tabindex="-1"></a>
                <label for="password">Пароль</label>
                <input id="password" type="password"
                       class="@error('password') error @enderror"
                       name="password" required autocomplete="new-password">
            </div>
            <div class="form-item">
                <a href="#" class="pass-show" tabindex="-1"></a>
                <label for="password_confirmation">Подтверждение пароля</label>
                <input id="password_confirmation" type="password_confirmation"
                       class="@error('password_confirmation') error @enderror"
                       name="password" required autocomplete="off">
            </div>
            <button id="submit" class="btn-blue" type="submit">Зарегистрироваться</button>
            @if (Route::has('login'))
                <a class="foget-pass" href="{{ route('login') }}">
                    Уже есть аккаунт?
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
