<div class="events-item-info">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="events-item-info-status">{{ $event->attachable->data }}</div>
    <div class="events-item-info-person">
        <b>Ответственный менеджер</b>
        <span>{{ $event->user->name }}</span>
    </div>
</div>
