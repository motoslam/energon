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
            <select name="filter_category" id="filter_category"
                    onchange="Livewire.emit('setFilterType', this.value);">
                <option value="all">Все события</option>
                <option value="comment">Комментарии</option>
                <option value="call">Телефонные звонки</option>
                <option value="order">Заказы</option>
                <option value="offer">Заявки</option>
                <option value="task">Задачи</option>
            </select>
        </div>
        <div class="date-range">
            <div class="date-range-item">
                <input wire:model="filterFromDate" placeholder="С"
                       class="start_one date" data-multiple-dates-separator=" - "
                       type="text" id="datepicker"
                       onchange="console.log(this.dispatchEvent(new InputEvent('input')))"
                />
            </div>
            <div class="date-range-item">
                <input wire:model="filterToDate" placeholder="По" type="text"
                       class="date end_one"
                       onchange="console.log(this.dispatchEvent(new InputEvent('input')))"
                />
            </div>
        </div>
    </div>
</div>
