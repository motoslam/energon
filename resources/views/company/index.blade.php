<x-app-layout title="Контрагенты" wrapper_css="">

    <x-slot name="header">
        <div class="content-box__top-line">
            <div class="container">
                <h1>Контрагенты</h1>
                <a href="{{ route('companies.create') }}" class="sys-header-button">
                    <span>Добавить организацию</span><img src="img/plus-blue.svg" alt="">
                </a>
                @include('filters.dashboard')
            </div>
        </div>
    </x-slot>

    <div class="table-wrap">
        <div class="container">
            <div class="table">
                <div class="table-tr">
                    <div class="table-th sys-no-select">Организация</div>
                    <div class="table-th sys-no-select">Город</div>
                    <div class="table-th sys-no-select">Контактное лицо</div>
                    <div class="table-th sys-no-select">телефон</div>
                    <div class="table-th sys-no-select">E-mail</div>
                    <div class="table-th sys-no-select">ИНН</div>
                    <div class="table-th sys-no-select">тип клиента</div>
                    <div class="table-th sys-no-select">Статус</div>
                </div>

                @foreach($companies as $company)
                    <div class="table-tr">
                        <a href="{{ route('companies.show', ['company' => $company]) }}" class="table-td">
                            <b>{{ $company->legal ?? '—' }}</b>
                            <span>{{ $company->name }}</span>
                        </a>
                        <div class="table-td">
                            <b>{{ $company->city->region->short_fd ?? '—' }}</b>
                            <span>{{ $company->city->name }}</span>
                        </div>
                        <div class="table-td">
                            <b>Генеральный директор</b>
                            <span>Максимов Кадим Назимович</span>
                        </div>
                        <div class="table-td">
                            <b>Рабочий телефон</b>
                            <span><a href="tel:+79102807901">+7 910 280 79 01</a></span>
                        </div>
                        <div class="table-td">
                            <b>Рабочий e-mail</b>
                            <span><a href="mailto:f1981@rambler.ru">f1981@rambler.ru</a></span>
                        </div>
                        <div class="table-td">
                            <b>ИНН</b>
                            <span>{{ $company->ssn }}</span>
                        </div>
                        <div class="table-td">
                            <b>Тип клиента</b>
                            <span>{{ $company->companyType->name }}</span>
                        </div>
                        <div class="table-td">
                            <div>
                                <a href="#" class="del" title="Действующий – постоянный">
                                <!--{{ $company->companyStatus->name }}-->
                                    Действ. (П)
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if($companies->isEmpty())
                <div class="sys-company-not-found">Контрагенты не найдены</div>
            @endif
        </div>
    </div>
</x-app-layout>
