<div class="contragent-form-box">
    <div class="personal-form">
        @if(Route::is('tasks.create'))
            <div class="personal-box">
                <div class="contragent-form__item">
                    <label for="company">Выберите организацию</label>
                    <select name="company" id="company">
                        @foreach(Auth::user()->companies as $item)
                            <option value="{{ $item->id }}"
                                {{ ($company and $item->id == $company->id) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @else
            <div class="personal-box">
                <div class="contragent-form__item contragent-form__item50">
                    <label for="company">Организация</label>
                    <span style="font-size: 14px">{{ $company->name }}</span>
                </div>
            </div>
        @endif
        <div class="personal-box">
            <div class="contragent-form__item contragent-form__item50">
                <label for="name">Заголовок</label>
                <input type="text" id="name" name="name"
                       @error('name') error @enderror
                       value="{{ $task->name ?? old('name') }}">
            </div>
        </div>
        <div class="personal-box">
            <div class="contragent-form__item contragent-form__item50">
                <label for="content">Описание</label>
                <textarea name="content" id="contebt">{{ $task->content ?? old('content') }}</textarea>
            </div>
        </div>

        <div class="personal-box">
            <div class="contragent-form__item">
                <label for="">Приоритет</label>
                <div class="priority-box">
                    <label class="priority priority-middle" for="middle"><input type="radio" name="input-priorites" id="middle"> <span><i></i></span></label>
                    <label class="priority priority-low" for="low"><input type="radio" name="input-priorites" id="low"> <span><i></i></span></label>
                    <label class="priority priority-high" for="high"><input type="radio" name="input-priorites" id="high"> <span><i></i></span></label>

                </div>
            </div>
        </div>

        <div class="personal-phones" x-data="{phones: ['{{ $phones ?? '' }}'], name: 'Номер телефона'}">
            <template x-for="(phone, index) in phones">
                <div class="contragent-form__item">
                    <label x-text="name + ' #' + (index + 1)">Номер телефона</label>
                    <input type="text" x-model="phones[index]" name="phones[]"
                           placeholder="+7" maxlength="16"
                           onkeypress='return onlyDigit(event.charCode)'/>
                    <template x-if="index > 0">
                        <a href="javascript:void(0)" @click.prevent="phones.splice(index, 1)"
                           class="remove"></a>
                    </template>
                </div>
            </template>
            <template x-if="phones.length < 3">
                <a href="javascript:void(0)" @click.prevent="phones.push('')" class="add-card">
                    <span>Добавить</span><i></i>
                </a>
            </template>
        </div>

        <div class="personal-mails" x-data="{emails: ['{{ $emails ?? '' }}'], name: 'Адрес электронной почты'}">
            <template x-for="(email, index) in emails">
                <div class="contragent-form__item">
                    <label x-text="name + ' #' + (index + 1)">Адрес электронной почты</label>
                    <input type="email" x-model="emails[index]" name="emails[]"/>
                    <template x-if="index > 0">
                        <a href="javascript:void(0)" @click.prevent="emails.splice(index, 1)"
                           class="remove"></a>
                    </template>
                </div>
            </template>
            <template x-if="emails.length < 3">
                <a href="javascript:void(0)" @click.prevent="emails.push('')" class="add-card">
                    <span>Добавить</span><i></i>
                </a>
            </template>
        </div>
    </div>

    <div class="form-btns">
        <button type="submit" class="btn-blue" style="margin-right: 25px;">{{ $btnText }}</button>
        <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn-cancel">Отмена
        </button>
        @if ($errors->any())
            <div class="message-form message-error">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</div>
