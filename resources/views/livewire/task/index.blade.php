<div class="dates-plans scrollbar-outer {{ $tasks->isEmpty() ? 'p0important' : '' }}">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    @if($tasks->isEmpty())
        <div class="date-plan-item" x-data="{quote: '{{ $quote }}' }">
            <div class="title quote" x-text="quote"></div>
        </div>
    @endif

    @foreach($tasks as $year => $year_months)
        @foreach($year_months as $month => $month_days)
            @foreach($month_days as $day => $day_tasks)
                <div class="date-plan-item">
                    <div class="title">
                        {{ $day }}
                        {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                        {{ ($year < now()->format('Y')) ? $year : '' }}
                    </div>
                    <div class="date-notes">
                        @foreach($day_tasks as $task)
                            <livewire:task.once :task="$task" :wire:key="$task->id" />
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>
