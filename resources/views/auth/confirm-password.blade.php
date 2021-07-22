@extends('layouts.guest')
@section('pagetitle', 'Подтвердите пароль')

@section('content')
    <div class="container">
        <div class="title-form">Подтвердите пароль</div>
        <form class="form-serv" action="{{ route('password.confirm') }}" method="post">
            @csrf
            <div class="sys-text-form">
                <strong>Это защищенная область приложения.</strong><br> Пожалуйста, подтвердите
                свой пароль, прежде чем продолжить.
            </div>
            <div class="form-item">
                <a href="#" class="pass-show" tabindex="-1"></a>
                <label for="password">Пароль</label>
                <input id="password" type="password"
                       class="@error('password') error @enderror"
                       name="password" required autocomplete="current-password">
            </div>
            <button id="submit" class="btn-blue" type="submit">Подтвердить</button>
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
