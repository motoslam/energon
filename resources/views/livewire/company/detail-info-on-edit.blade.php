<div>
    <div class="found-company" id="company_founded" {{ $show ? '' : 'hidden' }}>
        <div class="found-company-item">
            <span>Название организации</span>
            <b id="company_name">{{ $company->name  }}</b>
        </div>
        <div class="found-company-item">
            <span>ИНН</span>
            <b id="company_ssn">{{ $company->ssn  }}</b>
        </div>
        <div class="found-company-item">
            <span>Адрес</span>
            <b id="company_address">{{ $company->address  }}</b>
        </div>
        <div class="found-company-item">
            <span>Добавлена в систему</span>
            <b id="company_state">{{ $company->created_at->diffForHumans() }}</b>
        </div>
    </div>
    <div class="found-company-detail">
        <a href="javascript:void(0);" wire:click="update">
            Показать / скрыть информацию
        </a>
        <input type="checkbox" id="showDetailInfoCheckbox" wire:model="show" style="display:none;">
    </div>
</div>
