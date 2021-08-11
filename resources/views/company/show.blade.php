<x-app-layout title="Детальный просмотр: {{ $company->name }}" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('dashboard') }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        {{-- In work, do what you enjoy. --}}
        <div class="container">
            @if(session('success'))
                <div class="message-form message-ok message-ok-margins">
                    {{session('success')}}
                </div>
            @endif
            <div class="info-item-top">

                <livewire:company.detail :company="$company"/>

                <div class="info-item-top__right">
                    <div class="item-info">
                        <span>Тип контрагента</span>
                        <b>{{ $company->companyType->name }}</b>
                    </div>
                    <div class="item-info">
                        <span>Тип закупки</span>
                        <b>{{ $company->companyPurchase->name }}</b>
                    </div>
                    <div class="item-info">
                        <span>Потенциал</span>
                        <b>{{ $company->potentiality->name }}</b>
                    </div>
                    <div class="item-info">
                        <span>Ответственный менеджер </span>
                        <b>{{ $company->user->name }}</b>
                    </div>
                    <div class="btn-more-box">
                        <a class="btn-more" href="javascript:void(0)">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <div class="btn-el-items">
                            <a href="{{ route('companies.edit', ['company' => $company]) }}"
                               class="btn-el btn-edit"></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TODO: Вывести следующий блок когда будет понятна логика
                При статусе клиента «действующий - разовый» и «действующий – постоянный», выводить
                у контрагента: № Договора, № Спецификации, № Заявки, № Заказа, Дата заказа, Сумма заказов, %
                Премии менеджера, Кол-во рабочих часов, Тип оборудования.
                -->

            <x-company-contract :company="$company"/>

        </div>
    </div>

    <div class="elem-information">
        <div class="container">
            <div class="elem-information__btns">
                <a href="{{ route('companies.show', ['company' => $company]) }}"
                   class="btn-switch {{ Route::is('companies.show') ? 'active' : '' }}">Лента событий</a>
                <a href="{{ route('companies.contacts', ['company' => $company]) }}"
                   class="btn-switch {{ Route::is('companies.contacts') ? 'active' : '' }}">Контакты</a>
                <a href="{{ route('companies.tasks', ['company' => $company]) }}"
                   class="btn-switch {{ Route::is('companies.tasks') ? 'active' : '' }}">Задачи</a>
            </div>
            <a href="javascript:void(0)" class="btn-filter"><span>Фильтр</span></a>
            <div class="elem-information__box">
                <div class="elem-item">
                    @if(Route::is('companies.show'))
                        <livewire:company.feed :company="$company"/>
                    @endif
                    @if(Route::is('companies.contacts'))
                        <livewire:company.contacts :company="$company"/>
                    @endif
                    @if(Route::is('companies.tasks'))
                        TASKS
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            autosize(document.querySelectorAll('textarea'));

            function removeContact(id) {
                Swal.fire({
                    title: 'Вы уверены?',
                    text: 'После удаления восстановить контакт будет невозможно.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отмена'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#removeContact' + id).submit();
                    }
                });
            }
        </script>
    </x-slot>

</x-app-layout>
