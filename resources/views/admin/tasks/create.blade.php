<x-admin-layout title="Новая задача">

    <div class="app">
        <h4 class="mb-4">
            <a href="{{ route('admin.tasks.index') }}">Задачи</a> / Новая задача
        </h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tasks.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="taskUser" class="form-label">Пользователь:</label>
                        <select name="user_id" id="taskUser" class="form-select">
                            <option value="">Выберите пользователя</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="taskСompany" class="form-label">Компания (контрагент):</label>
                        <select name="company_id" id="taskСompany" class="form-select">
                            <option value="">Не выбрано</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Заголовок:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="taskName">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="mb-3">
                        <label for="taskContent" class="form-label">Описание:</label>
                        <textarea name="data" id="taskContent" cols="30"
                                  rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="mb-3">
                        <label for="taskPriority" class="form-label">Приоритет:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority_id" value="1" id="taskPriority1" checked>
                            <label class="form-check-label" for="taskPriority1">
                                Нормальный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority_id" value="2" id="taskPriority2">
                            <label class="form-check-label" for="taskPriority2">
                                Высокий
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority_id" value="3" id="taskPriority3">
                            <label class="form-check-label" for="taskPriority3">
                                Критичный
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><label for="taskDeadline" class="form-label">Крайний срок:</label></div>
                <div class="col-2 mb-3"><input type="date" name="deadline" id="taskDeadline" class="form-control"></div>
                <div class="col-2 mb-3"><input type="time" name="deadline_time" id="taskDeadlineTime" class="form-control"></div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Создать задачу</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</x-admin-layout>
