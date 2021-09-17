<div class="events-item-info">
    {{-- East or West home is best. --}}
    <div class="events-item-info-status">Заявка</div>
    <div class="events-item-info-note">
        <b>Номер заявки</b>
        <span>{{ $event->attachable->internal_id }}</span>
    </div>
    @if(!empty($event->attachable->data))
        <div class="events-item-info-note">
            <b>Комментарий</b>
            <span>{{ $event->attachable->data }}</span>
        </div>
    @endif
    <div class="events-item-info-person">
        <b>Дата заявки: {{ $event->attachable->offer_date->format('d.m.Y') }}</b>
        <span>{{ $event->attachable->user->name }}</span>
    </div>
</div>
