<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="events-box">
        <div class="events-items">

            <!-- Форма добавления -->
            <livewire:company.create-event :company="$company" />

            @forelse($company->events as $event)
                <div class="events-item {{ $event->attachable->template ?? '' }}">
                    <div class="events-item-date">{{ $event->created_at->diffForHumans() }}</div>
                    <div class="events-item-title">{{ $event->title }}</div>
                    @if( $event->attachable )
                        <livewire:company.attach :event="$event"/>
                    @endif
                </div>
            @empty
                <div class="events-item">
                    <div class="events-item-date">Список событий пуст</div>
                </div>
            @endforelse

        </div>

        <div class="events-dates">
            <a href="#" class="btn-new-event"><span>Добавить событие</span><img src="img/plus-blue.svg"
                                                                                alt=""></a>
            <div class="select-box">
                <span>Категория:</span>
                <select name="" id="">
                    <option value="Телефонный звонок">Телефонный звонок</option>
                    <option value="Заказ">Заказ</option>
                    <option value="Заявка">Заявка</option>
                    <option value="Заявка">Задача</option>
                </select>
            </div>
            <div class="date-range">
                <div class="date-range-item">
                    <input placeholder="С" class="start_one" data-multiple-dates-separator=" - "
                           type="text" class="date" id="datepicker">
                </div>
                <div class="date-range-item">
                    <input placeholder="По" type="text" class="date end_one">
                </div>
            </div>
        </div>
    </div>

</div>
