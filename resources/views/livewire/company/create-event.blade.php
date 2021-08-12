<div class="new-event-box" style="display: none;">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{--<div class="new-event-box__top">
        <div class="new-event-date">Сегодня, {{ now()->format('H:i') }}</div>
        <a href="javascript:void(0)">Отменить</a>
    </div>
    <form action="/" method="post"
          wire:submit.prevent="store()"
          class="form-new-task events-item task new-task green">
        <div class="title">Новое событие</div>
        <div class="form-new-task__box">

            <div class="form-new-task__item">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="@error('title') error @enderror">
            </div>
            <div class="form-new-task__item">
                <label for="event_type">Тип события</label>
                <select name="event_type" id="event_type">
                    <option value="1">Заявка</option>
                    <option value="2">Заказ</option>
                    <option value="3">Задача</option>
                    <option value="4">Телефонный звонок</option>
                    <option value="5">Комментарий</option>
                </select>
            </div>
        </div>
        <div class="form-new-task__item">
            <label for="data">Комментарий </label>
            <textarea name="data" id="data"></textarea>
        </div>
        <div class="form-new-task__item">
            <label for="data">Приоритет </label>
            <input type="radio" name="" id="">
        </div>
        <div class="form-new-task__item">
            <label for="data">Дата </label>
            <input type="date" name="" id="">
        </div>
        <div class="form-new-task__item">
            <label for="data">время с по </label>
            <input type="date" name="" id="">
        </div>
        <div class="form-btns">
            <button type="submit" class="btn-blue">Создать</button>
            @if ($errors->any())
                <div class="message-form message-error">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </form>--}}

</div>
