<x-admin-layout title="Задачи">

    <div class="app">
        <h4 class="mb-4">
            Задачи
        </h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('admin.tasks.index') }}" method="get">
            <div class="row g-3 mb-5">
                <div class="col-3">
                    <select name="user" id="user" class="form-select">
                        <option value="">Выберите пользователя</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <div class="input-group">
                        <span class="input-group-text">с</span>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username">
                        <span class="input-group-text">по</span>
                        <input type="date" class="form-control" placeholder="Server" aria-label="Server">
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-outline-primary">Применить</button>
                </div>
            </div>
        </form>

        <div class="row mb-3">
            <div class="col">
                <span class="d-flex justify-content-center text-black fw-bold">Новая</span>
            </div>
            <div class="col">
                <span class="d-flex justify-content-center text-primary fw-bold">В работе</span>
            </div>
            <div class="col">
                <span class="d-flex justify-content-center text-warning fw-bold">Ожидает проверки</span>
            </div>
            <div class="col">
                <span class="d-flex justify-content-center text-success fw-bold">Завершена</span>
            </div>
            <div class="col">
                <span class="d-flex justify-content-center text-danger fw-bold">Отменена</span>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('admin.tasks.create') }}" class="admin-task-new">Новая задача</a>
                @if(isset($tasks[1]))
                    @foreach($tasks[1] as $task)
                        @include('admin.tasks.once')
                    @endforeach
                @endif
            </div>
            <div class="col">
                @if(isset($tasks[2]))
                    @foreach($tasks[2] as $task)
                        @include('admin.tasks.once')
                    @endforeach
                @endif
            </div>
            <div class="col">
                @if(isset($tasks[5]))
                    @foreach($tasks[5] as $task)
                        @include('admin.tasks.once')
                    @endforeach
                @endif
            </div>
            <div class="col">
                @if(isset($tasks[3]))
                    @foreach($tasks[3] as $task)
                        @include('admin.tasks.once')
                    @endforeach
                @endif
            </div>
            <div class="col">
                @if(isset($tasks[4]))
                    @foreach($tasks[4] as $task)
                        @include('admin.tasks.once')
                    @endforeach
                @endif
            </div>
        </div>

    </div>

</x-admin-layout>
