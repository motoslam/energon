<div class="events-item-info">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="events-item-info-status">{{ $event->attachable->name }}</div>
    <div class="events-item-info-note">
        <span><a href="javascript:void(0);">Детальная информация</a></span>
    </div>
    <div class="events-item-info-person">
        <b>Ответственный менеджер</b>
        <span>{{ $event->attachable->user->name }}</span>
    </div>
</div>
