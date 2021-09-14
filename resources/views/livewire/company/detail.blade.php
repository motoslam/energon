<div class="info-item-top__left">

    <div class="info-item-title">
        <b>{{ $company->full_name }}</b>

        <livewire:company.status :company="$company" />

    </div>

    <div class="info-item-content">
        <div x-data>
            <div x-show="!$wire.optionEditDescription"
                 @click="$wire.toggleEditDescription(); $nextTick(() => { setTimeout(() => { $refs.autofocus.focus(); }, 50); });"
                 class="sys-pointer {{ $company->description ? '' : 'sys-placeholder' }}"
                 title="Нажмите здесь для редактирования краткого описания"
            >
                @empty($company->description)
                    <p>Нажмите здесь для редактирования краткого описания</p>
                @else
                    @foreach( explode(PHP_EOL, $company->description) as $str )
                        <p>{{ $str }}</p>
                    @endforeach
                @endempty
            </div>
            <div x-show="$wire.optionEditDescription" class="sys-form"
                 x-cloak>
                <textarea name="company-description" id="company-description"
                          wire:model="companyDescription"
                          @keyup.shift.enter.window="$wire.saveDescription()"
                          @keyup.escape.window="$wire.closeEditDescription()"
                          x-ref="autofocus"></textarea>
                <div class="sys-help">
                    <div>Shift+Enter для сохранения изменений</div>
                    <div class="sys-help-actions">
                        <a href="#" @click.prevent="$wire.closeEditDescription()" class="sys-help-cancel">Отменить</a>
                        <span></span>
                        <a href="#" @click.prevent="$wire.saveDescription()">Сохранить изменения</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="info-item-address">
        <div>
            <span>ИНН</span>
            <b>{{ $company->ssn }}</b>
        </div>
        <div>
            <span>Город</span>
            <b>
                {{ $company->city->name }}
            </b>
        </div>
        <div>
            <span>Текущее время</span>
            <b>
                <script>
                    var tableWatchTime = new Date();
                </script>
                <i id="tableWatch"
                   data-hour="{{ now()->timezone($company->city->timezone_offset)->format('H') }}"
                   data-min="{{ now()->timezone($company->city->timezone_offset)->format('i') }}"
                   data-sec="{{ now()->timezone($company->city->timezone_offset)->format('s') }}"
                >
                    —
                </i>
            </b>
        </div>
        <div>
            <span>Адрес</span>
            <b>{{ $company->address }}</b>
        </div>
    </div>
</div>
