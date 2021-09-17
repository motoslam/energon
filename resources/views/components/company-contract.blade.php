<div class="elem-line" {{ in_array($company->company_status_id, [2, 3]) ? '' : 'hidden' }}>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <div class="elem-line__content">
        <div>
            <span>№ Договора</span>
            <b>{{ $company->contract ?? '—' }}</b>
        </div>
        <div>
            <span>№ Спецификации</span>
            <b>{{ $company->specification ?? '—' }}</b>
        </div>
        <div>
            <span>№ Заявки</span>
            <b>{{ $company->offer_number ?? '—' }}</b>
        </div>
        <div>
            <span>№ Заказа</span>
            <b>{{ $company->order_number ?? '—' }}</b>
        </div>
        <div>
            <span>Дата заказа</span>
            <b>{{ $company->order_date ?? '—' }}</b>
        </div>
        <div>
            <span>Сумма заказов</span>
            <b>{{ $company->order_total ?? '—' }}</b>
        </div>
        <div>
            <span>% Премии менеджера</span>
            <b>{{ $company->manager_bonus ?? '—' }}</b>
        </div>
        <div>
            <span>Кол-во рабочих часов</span>
            <b>{{ $company->working_hours ?? '—' }}</b>
        </div>
        <div>
            <span>Тип оборудования</span>
            <b>{{ $company->equipment ?? '—' }}</b>
        </div>
    </div>
    <div class="btn-more-box">
        <a class="btn-more" href="javascript:void(0)">
            <span></span>
            <span></span>
            <span></span>
        </a>
        <div class="btn-el-items">
            <a href="{{ route('companies.edit', ['company' => $company]) }}" class="btn-el btn-edit"></a>
        </div>
    </div>
</div>

