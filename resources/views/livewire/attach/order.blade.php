<div class="events-item-info">
    {{-- Out of sight out of mind. --}}
    <div class="events-item-info-status">Заказ</div>
    <div class="events-item-info-note">
        <b>Номер заказа</b>
        <span>{{ $event->attachable->internal_id }}</span>
    </div>
    <div class="events-item-info-note">
        <b>Сумма заказа</b>
        <span>{{ $event->attachable->sum }}</span>
    </div>
    @if(!empty($event->attachable->data))
    <div class="events-item-info-note">
        <b>Комментарий</b>
        <span>{{ $event->attachable->data }}</span>
    </div>
    @endif
    <div class="events-item-info-person">
        <b>Дата заказа: {{ $event->attachable->order_date->format('d.m.Y') }}</b>
        <span>{{ $event->attachable->user->name }}</span>
    </div>
</div>
