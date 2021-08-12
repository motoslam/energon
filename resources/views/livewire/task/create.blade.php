<div class="plans-request-form">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="title">Создать задачу</div>
    <form action="/" method="POST" class="form-request" onsubmit="return false;">
        <div class="form-request__item">
            <label for="name">Заголовок</label>
            <input type="text" wire:model="name" id="name"
                   name="name" class="@error('name') error @enderror">
        </div>
        <div class="form-request__item">
            <label for="content">Описание</label>
            <textarea name="content" id="content"
                      wire:model="content"></textarea>
        </div>
        <div class="form-request__item">
            <label for="priority">Приоритет</label>
            <div class="priority-box">
                <label class="priority priority-low" for="regular" title="Нормальный">
                    <input type="radio" wire:model="priority_id" value="regular"
                           name="input-priorites" id="regular">
                    <span><i></i></span></label>
                <label class="priority priority-middle" for="average" title="Высокий">
                    <input type="radio" wire:model="priority_id" value="average"
                           name="input-priorites" id="average">
                    <span><i></i></span>
                </label>
                <label class="priority priority-high" for="critical" title="Критичный">
                    <input type="radio" wire:model="priority_id" value="critical"
                           name="input-priorites" id="critical">
                    <span><i></i></span>
                </label>
            </div>
        </div>
        <div class="form-request__item" style="margin-top: 15px;" x-data>
            <label for="deadline">Крайний срок</label>
            <input type="date" name="deadline"
                   id="deadline" wire:model="deadline" :min="$wire.deadline"
                   autocomplete="off"/>
        </div>
        <div class="dates-request">
            <input type="time" id="time-from" wire:model="time"/>
        </div>
        @if ($errors->any())
            <div class="message-form message-error">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit" wire:click.prevent="create" class="btn-blue">Добавить</button>
    </form>

</div>
