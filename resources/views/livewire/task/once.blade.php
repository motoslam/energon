<div class="date-note-item {{ $task->priority_id }} {{ $expired ? 'task-expired' : '' }}">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="time">
        <div class="time-start">
            {{ $task->deadline_at->format('H:i') }}
        </div>
        @if($expired)
            <div class="time-finish">
                {{ $expired_at > 0 ? $expired_at . ' дн.' : '' }}
            </div>
        @endif
    </div>
    <div class="date-note-desc">
        <a href="{{ route('tasks.show', ['task' => $task]) }}"
           class="name-note">
            {{ $task->name }}
        </a>
        <div class="desc-note">{{ $task->content }}</div>
    </div>
</div>
