<div class="new-event-box" x-data="{ active: @entangle('isActive'), type: @entangle('type') }"
     @oef.window="active = true" x-show="active" x-cloak>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="new-event-box__top">
        <div class="new-event-date">Сегодня, {{ now()->format('H:i') }}</div>
        <a href="javascript:void(0)" @click.prevent="active = false">Отменить</a>
    </div>

    <script>
        var eventType = 'comment';
    </script>

    <form wire:submit.prevent="store()" class="form-new-task events-item task new-task green">

        <div class="title">Новое событие</div>
        <div class="form-new-task__box" wire:ignore>
            <div class="form-new-task__item">
                <label for="js_type">Тип события</label>
                <select name="js_type" id="js_type"
                        onchange="Livewire.emit('changeEventType', this.value)">
                    <option value="comment">Комментарий</option>
                    <option value="order">Заказ</option>
                </select>
            </div>
        </div>

        <div class="form-new-task__box" x-show="type=='order'" x-cloak>
            <div class="form-new-task__item">
                <label for="internal_id">Номер заказа</label>
                <input type="text" name="internal_id" id="internal_id"
                       wire:model="internal_id" />
            </div>
            <div class="form-new-task__item">
                <label for="order_sum">Сумма</label>
                <input type="text" name="order_sum" id="order_sum"
                       wire:model="order_sum" />
            </div>
        </div>

        <div class="form-new-task__item">
            <label for="data">Комментарий </label>
            <textarea name="data" id="data" wire:model="data"></textarea>
        </div>

        <div class="form-new-task__box" wire:ignore x-show="type=='comment'" x-cloak>
            <div class="form-new-task__item" style="width: 100%;">
                <label for="contact">Контактное лицо </label>
                <select name="contact" id="contact"
                        onchange="Livewire.emit('changeEventContact', this.value)">
                    <option value="" disabled selected>Не выбрано</option>
                </select>
            </div>
        </div>

        <div class="form-new-task__item" x-show="type=='order'" x-cloak>
            <label for="order_date">Дата заказа </label>
            <input class="date-request" name="order_date" id="order_date" type="text"
                   wire:model="order_date" />
        </div>

        <div class="form-btns" style="border: none">
            <button type="submit" class="btn-blue">Добавить событие</button>
            @if ($errors->any())
                <div class="message-form message-error" style="margin-top: 0;">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </form>
</div>

