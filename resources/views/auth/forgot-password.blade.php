@extends('layouts.guest')
@section('pagetitle', 'Восстановление доступа')

@section('content')
    <div class="container">
        <div class="title-form">Восстановление доступа</div>
        <form class="form-serv" action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="form-item">
                <label for="email">Электронная почта</label>
                <input type="email" required id="email" name="email"
                       class="@error('email') is-invalid @enderror"
                       value="{{ old('email') }}" autocomplete="email"
                       autofocus />
            </div>
            <button id="submit" class="btn-blue" type="submit">Отправить ссылку</button>
        </form>

        @if (session('status'))
            <div class="message-form message-ok" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
        <div class="message-form message-error" role="alert">
            {{ $message }}
        </div>
        @enderror

    </div>
@endsection
