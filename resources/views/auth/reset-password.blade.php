@extends('layouts.guest')
@section('pagetitle', 'Восстановление доступа')

@section('content')
    <div class="container">
        <div class="title-form">Восстановление доступа</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="form-serv" action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-item">
                <label for="email">Электронная почта</label>
                <input type="email" required id="email" name="email"
                       class="@error('email') is-invalid @enderror"
                       value="{{ old('email', $request->email) }}" autocomplete="email" />
            </div>
            <div class="form-item">
                <a href="javascript:void(0);" class="pass-show" tabindex="-1"></a>
                <label for="password">Пароль</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
            </div>
            <div class="form-item">
                <a href="javascript:void(0);" class="pass-show" tabindex="-1"></a>
                <label for="password-confirm">Пароль</label>
                <input id="password-confirm" type="password"
                       class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button id="submit" class="btn-blue" type="submit">Сменить пароль</button>
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
