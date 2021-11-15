<x-admin-layout title="Детальная информация о пользователе {{ $user->name }}">

    <div class="app">
        <h4 class="mb-4">
            <a href="{{ route('admin.users.index') }}">Пользователи</a> / {{ $user->name }}
        </h4>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.users.show', ['user' => $user]) }}">
                    Статистика
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Задачи
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.edit', ['user' => $user]) }}">
                    Редактировать данные
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" data-toggle="confirmation" data-title="Вы уверены?"
                   href="#" onclick="adminConfirm(function() {
                     document.getElementById('userDelete').submit();
                   })">
                    Удалить пользователя
                </a>
                <form action="{{ route('admin.users.destroy', ['user' => $user]) }}"
                      method="post" id="userDelete">
                    @csrf
                    @method('DELETE')
                </form>
            </li>
        </ul>

    </div>

</x-admin-layout>
