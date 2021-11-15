<div class="events-box">
    {{-- Success is as dangerous as failure. --}}
    <div class="events-items">

        <!-- Форма добавления -->
        <livewire:company.create-event :company="$company"/>

        @forelse($events as $event)
            <div class="events-item {{ $event->template }}">
                <div class="events-item-date" style="padding-left: 0;">{{ $event->created_at->diffForHumans() }}</div>
                <div class="events-item-title">{{ $event->title }}</div>
                @if( $event->attachable )
                    <livewire:company.attach :event="$event" key="{{now()}}"/>
                @endif
            </div>
        @empty
            <div class="events-item">
                <div class="events-item-date">Список событий пуст</div>
            </div>
        @endforelse

    </div>

    <div class="events-dates" x-data>
        <a href="#addEvent" class="btn-new-event" @click.prevent="$dispatch('oef')">
            <span>Добавить событие</span><img src="img/plus-blue.svg" alt="">
        </a>
        <div class="select-box" wire:ignore>
            <span>Категория:</span>
            <select name="type" id="type"
                    onchange="Livewire.emit('setFilterType', this.value);">
                <option value="all">Все события</option>
                <option value="comment">Комментарии</option>
                <option value="call">Телефонные звонки</option>
                <option value="order">Заказы</option>
                <option value="offer">Заявки</option>
                <option value="task">Задачи</option>
            </select>
        </div>
        <div class="browser-date-range">
            <div class="input">
                <input type="date" wire:model="from" placeholder="C" />
            </div>
            <div class="input">
                <input type="date" wire:model="to" placeholder="По" class="last" />
            </div>
        </div>
    </div>
</div>
