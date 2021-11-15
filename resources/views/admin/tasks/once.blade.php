<div class="admin-task">
    <div class="admin-task-priority">
        <span class="admin-task-priority-{{ $task->task_status_id }}"></span>
    </div>
    <div class="admin-task-date">
        {{ $task->created_at->format('d.m.Y H:i') }}
    </div>
    <div class="admin-task-title">
        {{ $task->name }}
    </div>
    @if($task->deadline_at)
        <div class="admin-task-deadline">
            Срок: <span>до {{ $task->deadline_at->format('d.m.Y H:i') }}</span>
        </div>
    @endif
    <div class="admin-task-user">
        {{ $task->user->name }}
    </div>
    <a href="{{ route('tasks.show', ['task' => $task]) }}"
       class="btn btn-sm btn-outline-primary" target="_blank">
        Подробнее
    </a>
</div>
