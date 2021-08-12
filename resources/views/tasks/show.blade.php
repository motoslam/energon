<x-app-layout title="Задача: {{ $task->name }}" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="message-box">

                <div class="message-box__left">
                    <div class="request-info">
                        @if($task->senior)
                            <div class="request-info__item">
                                <span>Постановщик</span>
                                <b>{{ $task->senior->name }}</b>
                            </div>
                        @endif
                        @if($task->company)
                            <div class="request-info__item">
                                <span>Контрагент</span>
                                <b>{{ $task->company->name }}</b>
                            </div>
                        @endif
                        <div class="request-info__item">
                            <span>Дата создания</span>
                            <b>{{ $task->created_at->diffForHumans() }}</b>
                        </div>
                        @if($task->user != $user)
                            <div class="request-info__item">
                                <span>Ответственный менеджер</span>
                                <b>{{ $task->user->name }}</b>
                            </div>
                        @endif
                        <div class="request-info__item">
                            <span>Статус</span>
                            <b class="task-status-color{{ $task->task_status_id }}">
                                {{ $task->status->name }}
                            </b>
                        </div>
                        <div class="request-info__item">
                            <span>Крайний срок</span>
                            <b>{{ $task->deadline_at->format('d.m.Y H:i') }}</b>
                        </div>
                        <div class="request-info__item request-info__priority
                                    request-info__priority_{{ $task->priority_id }}">
                            <span>Приоритет</span>
                            <b><i></i> {{ $task->priority }}</b>
                        </div>
                        @if($task->need_confirm)
                            <div class="request-info__item">
                                <span>Условия завершения</span>
                                <b>Требуется подтверждение</b>
                            </div>
                        @endif
                        @if($task->started_at)
                            <div class="request-info__item">
                                <span>Взята в работу</span>
                                <b>{{ $task->started_at->diffForHumans() }}</b>
                            </div>
                        @endif
                        <div class="request-info__item remove-task-box">
                            <span>или</span>
                            <a href="javascript:void(0);" class="remove-task" onclick="removeTask()">
                                Удалить задачу
                            </a>
                            <form action="{{ route('tasks.destroy', ['task' => $task]) }}"
                                  method="post" id="removeTask">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>

                <div class="message-box__right">
                    <div class="request-messages">
                        <div class="request-messages-top">
                            <b>Задача #{{ $task->id }}</b>
                            <div class="title">{{ $task->name }}</div>
                            <div class="desc">{{ $task->content }}</div>
                            <div class="request-messages-date">
                                <label for="">Сменить статус</label>
                                <select name="status" id="status" class="js-native data-messages">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if($task->expired)
                            <div class="task-expired-message">
                                <div class="message-form message-error">
                                    Крайний срок выполнения задачи истек {{ $task->deadline_at->diffForHumans() }}.
                                </div>
                            </div>
                        @endif

                        <livewire:chat.input :task="$task" :user="$user"/>

                        <livewire:chat.messages-list :task="$task" :user="$user"/>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            autosize(document.querySelectorAll('textarea'));

            function removeTask() {
                Swal.fire({
                    title: 'Вы уверены?',
                    text: 'Задача будет перемещена в корзину.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отмена'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#removeTask').submit();
                    }
                });
            }

        </script>
    </x-slot>

</x-app-layout>
