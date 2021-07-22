@extends('layouts.guest')
@section('pagetitle', 'Подтверждение адреса электронной почты')

@section('content')
    <div class="container">
        <div class="title-form" style="line-height: 150%;">Подтверждение адреса<br> электронной почты</div>
        @if (session('status') == 'verification-link-sent')
            <div class="message-form message-ok" style="margin-bottom: 23px" role="alert">
                Cсылка для подтверждения была отправлена на адрес электронной почты, указанный при регистрации.
            </div>
        @endif
        <form class="form-serv" action="{{ route('verification.send') }}" method="post">
            <div class="sys-text-form">
                Вы зарегистрированы! Прежде чем приступить к работе, необходимо подтвердить адрес
                электронной почты, перейдя по ссылке, которая была отправлена вам при регистрации.
                Не получили электронное письмо? Мы вышлем вам еще одно, если нажмете на кнопку ниже.
            </div>
            @csrf
            <button id="submit" class="btn-blue" type="submit">Отправить письмо еще раз</button>
        </form>

        <a class="foget-pass" href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
            Выйти из учетной записи
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
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
