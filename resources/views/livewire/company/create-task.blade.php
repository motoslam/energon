<div class="feed-tasks__right">
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="plans-request" id="objToStick">

        <div class="plans-request-form">
            <div class="title">Новая задача</div>
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
                        <label class="priority priority-low" for="regular">
                            <input type="radio" wire:model="priority" value="regular"
                                   name="input-priorites" id="regular">
                            <span><i></i></span></label>
                        <label class="priority priority-middle" for="average">
                            <input type="radio" wire:model="priority" value="average"
                                   name="input-priorites" id="average">
                            <span><i></i></span>
                        </label>
                        <label class="priority priority-high" for="critical">
                            <input type="radio" wire:model="priority" value="critical"
                                   name="input-priorites" id="critical">
                            <span><i></i></span>
                        </label>

                    </div>


                </div>
                <div class="form-request__item" style="margin-top: 15px;">
                    <label for="deadline">Дата</label>
                    <input type="date" name="deadline"
                           id="deadline" wire:model="deadline" autocomplete="off" />
                </div>
                <div class="dates-request">
                    <input type="time" id="time-from" wire:model="start" />
                    <input type="time" id="time-to" wire:model="end" />
                </div>
                @if ($errors->any())
                    <div class="message-form message-error">
                        {{ $errors->first() }}
                    </div>
                @endif
                <button type="submit" wire:click.prevent="create" class="btn-blue">Добавить</button>
            </form>

        </div>
    </div>


</div>


