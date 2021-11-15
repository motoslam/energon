<x-admin-layout title="Список пользователей">

    <div class="app">
        <h4 class="mb-4">
            Пользователи
        </h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="btn-group mb-5">
            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary">Создать пользователя</a>
            @if(Route::is('admin.users.trash') )
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success">Активные пользователи</a>
            @else
                <a href="{{ route('admin.users.trash') }}" class="btn btn-outline-dark">Удаленные пользователи</a>
            @endif
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Адрес электронной почты</th>
                <th>Роль в системе</th>
                <th style="max-width: 50px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        @if(Route::is('admin.users.trash') )
                            <a href="javascript:void(0);"
                               onclick="document.getElementById('restoreUser{{ $user->id }}').submit();"
                               class="text-primary" >Восстановить</a>
                            <form action="{{ route('admin.users.restore', ['user' => $user]) }}" method="post"
                                  id="restoreUser{{ $user->id }}">
                                @csrf
                            </form>
                        @else
                        <a href="{{ route('admin.users.show', ['user' => $user]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 class="block w-6 h-6 fill-gray-400">
                                <polygon
                                    points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"></polygon>
                            </svg>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
