<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="feed-tasks-box">
        <div class="feed-tasks__left">
            @if($company->tasks()->count() == 0)
                <div class="dates-plans scrollbar-outer" style="padding: 0 !important;">
                    <div class="date-plan-item">
                        <div class="title">Список задач пуст</div>
                    </div>
                </div>
            @else
                <div class="dates-plans scrollbar-outer">
                    @foreach($tasks as $year => $data)
                        @foreach($data as $month => $month_days)
                            @foreach($month_days as $day => $day_tasks)
                                <div class="date-plan-item">
                                    <div class="title">
                                        {{ $day }}
                                        {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                                        {{ ($year < now()->format('Y')) ? $year : '' }}
                                    </div>
                                    <div class="date-notes">
                                        @foreach($day_tasks as $task)
                                            <div class="date-note-item {{ $task->priority }}">
                                                <div class="time">
                                                    <div class="time-start">
                                                        {{ $task->deadline_at->format('H:i') }}
                                                    </div>
                                                    <div class="time-finish">
                                                        {{ $task->deadline_at->addHour($task->timer)->format('H:i') }}
                                                    </div>
                                                </div>
                                                <div class="date-note-desc">
                                                    <a href="{{ route('tasks.show', ['task' => $task]) }}"
                                                       class="name-note">
                                                        {{ $task->name }}
                                                    </a>
                                                    <div class="desc-note">{{ $task->content }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>

        <div class="feed-tasks__right">
            <livewire:company.create-task :company="$company"/>
        </div>

    </div>
</div>
