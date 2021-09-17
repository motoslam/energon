<div class="events-item-info">
    {{-- Out of sight out of mind. --}}
    <div class="events-item-info-status">Телефонный звонок</div>
    @if(!empty($event->attachable->data))
        <div class="events-item-info-note">
            <b>Комментарий</b>
            <span>{{ $event->attachable->data }}</span>
        </div>
    @endif
    @if(!empty($event->attachable->contact))
        <div class="events-item-info-person">
            <b>Контактное лицо</b>
            <span>{{ $event->attachable->contact->name }}</span>
        </div>
    @endif
</div>
