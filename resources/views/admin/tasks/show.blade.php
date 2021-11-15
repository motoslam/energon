<x-admin-layout title="Просмотр задачи #{{ $task->id }}">

    <div class="app">
        <h4 class="mb-4">
            <a href="{{ route('admin.tasks.index') }}">Задачи</a> / Просмотр задачи #{{ $task->id }}
        </h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif



    </div>

</x-admin-layout>
