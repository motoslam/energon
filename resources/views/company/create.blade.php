<x-app-layout title="Создание нового контрагента" wrapper_css="wrapper-edit">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('companies.create') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Создание нового контрагента</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div x-data>
        <div class="form-contragent-wrap-search">
            <div class="container">
                <form action="#" method="post" class="contragent-form" onsubmit="return false;">
                    <div class="contragent-form__item contragent-form__item50">
                        <label for="search">Поиск организаций по названию, ИНН, ОГРН и КПП</label>
                        <input type="search" id="searchBySSN"
                               placeholder=""
                               autocomplete="off">
                    </div>
                    <div class="found-company" id="company_founded" hidden>
                        <div class="found-company-closed" id="company_error" hidden>
                            <div class="message-form message-lock" id="company_error_message"></div>
                        </div>
                        <div class="found-company-item">
                            <span>Название организации</span>
                            <b id="company_name"></b>
                        </div>
                        <div class="found-company-item">
                            <span>ИНН</span>
                            <b id="company_ssn"></b>
                        </div>
                        <div class="found-company-item">
                            <span>Адрес</span>
                            <b id="company_address"></b>
                        </div>
                        <div class="found-company-item">
                            <span>Статус организации</span>
                            <b id="company_state"></b>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="TESTDATA">
            <div x-data="statusData()">
                <ul>
                    <template x-for="status in statuses" :key="status.id">
                        <li>
                            <span x-text="status.name"></span>
                        </li>
                    </template>
                </ul>
            </div>
            <script>
                window.companyStatuses = [];

                async function loadData() {
                    const response = await fetch("/json/classifieds/company/statuses")
                    const data = await response.json()
                    window.companyStatuses = data
                    console.log(data)
                }

                loadData()

                console.log(window.companyStatuses)

                function statusData() {
                    return {
                        statuses: window.companyStatuses,
                        init() {
                            loadData()
                        }
                    }
                }

                /*const statusData = {
                    statuses: [],
                    initialize() {
                        async function loadData() {
                            const response = await fetch("/json/classifieds/company/statuses")
                            const data = await response.json()
                            statusData.statuses = data.data
                        }

                        loadData()

                        //console.log(this.statuses)
                    }
                }*/
            </script>
        </div>

        <div class="form-contragent-wrap form-contragent-wrap-no-border-radius">
            <div class="container">

                <form action="{{ route('companies.store') }}" class="contragent-form" method="post">
                    @csrf

                    <div class="contragent-form-box">
                        <div class="contragent-form__item js-hidden-contragent-item">
                            <label for="ssn">ИНН</label>
                            <input type="text" id="ssn" name="ssn" class="@error('ssn') error @enderror"
                                   value="{{ old('ssn') }}" disabled tabindex="-1" aria-disabled="disabled"/>
                        </div>
                        <div class="contragent-form__item js-hidden-contragent-item">
                            <label for="full_name">Название организации</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                   disabled tabindex="-1" aria-disabled="disabled">
                        </div>
                        <div class="contragent-form__item js-hidden-contragent-item">
                            <label for="city">Город</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                   disabled tabindex="-1" aria-disabled="disabled">
                        </div>
                        <div class="contragent-form__item js-hidden-contragent-item">
                            <label for="address">Адрес</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                   disabled tabindex="-1" aria-disabled="disabled">
                        </div>
                        <div class="contragent-form__item">
                            <label for="company_type">Тип контрагента</label>
                            <select name="company_type" id="company_type"
                                    class="@error('company_type') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите тип контрагента</option>
                                @foreach($companyTypes as $companyType)
                                    <option value="{{ $companyType->id }}">{{ $companyType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contragent-form__item">
                            <label for="company_purchase">Тип закупки</label>
                            <select name="company_purchase" id="company_purchase"
                                    class="@error('company_purchase') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите тип закупки</option>
                                @foreach($companyPurchases as $companyPurchase)
                                    <option value="{{ $companyPurchase->id }}">
                                        {{ $companyPurchase->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="contragent-form__item"
                             x-data="{statuses: []}"
                             x-init="statuses = await (await fetch('{{ route('json.classifieds.company.statuses') }}')).json();">
                            <label for="company_status">Статус контрагента</label>
                            <select name="company_status" id="company_status"
                                    class="@error('company_status') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите статус контрагента</option>
                                <template x-for="status in statuses" :key="status.id">
                                    <option :value="status.id" x-text="status.name"></option>
                                </template>
                            </select>
                        </div>--}}

                        <div class="contragent-form__item">
                            <label for="company_potentiality">Потенциал</label>
                            <select name="company_potentiality" id="company_potentiality"
                                    class="@error('company_potentiality') error @enderror">
                                <option value="" disabled selected data-display=" ">
                                    Выберите потенциал контрагента
                                </option>
                                @foreach($companyPotentialities as $companyPotentiality)
                                    <option value="{{ $companyPotentiality->id }}">
                                        {{ $companyPotentiality->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contragent-form__item big">
                            <label for="description">Краткое описание</label>
                            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-btns">
                            <button type="submit" class="btn-blue">Добавить</button>
                            @if ($errors->any())
                                <div class="message-form message-error">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery.suggestions.min.js') }}"></script>
        <script src="{{ asset('js/swal.min.js') }}"></script>
        <script>
            autosize(document.querySelectorAll('textarea'));

            $("#searchBySSN").suggestions({
                token: "a6f4b8b9573f6f8b55da539b89887e9ba4167f9a",
                type: "PARTY",
                scrollOnFocus: true,
                onSelect: function (suggestion) {
                    suggestionMachine.printSuggestion(suggestion);
                },
                onSelectNothing: function (query) {
                    suggestionMachine.collapseResult();
                }
            });

            let suggestionMachine = {
                'errorTypeClasses': 'message-lock message-error',
                'stateEnum': {
                    'ACTIVE': 'Действующая',
                    'LIQUIDATING': 'Ликвидируется',
                    'LIQUIDATED': 'Ликвидирована',
                    'BANKRUPT': 'Банкротство',
                    'REORGANIZING': 'В процессе присоединения с последующей ликвидацией',
                },
                'collapseResult': function () {
                    $('#company_founded').slideUp(200);
                },
                'clearError': function () {
                    $('#company_error_message').html('');
                    $('#company_error').hide();
                },
                'showError': function (eMessage, eLink = '', eType = 'error') {
                    $('#company_error_message')
                        .removeClass(this.errorTypeClasses)
                        .addClass('message-' + eType)
                        .html(eMessage);
                    $('#company_error').removeAttr('hidden').show();
                },
                'printSuggestion': function (suggestion) {
                    this.clearError();
                    $('#company_founded').slideUp(200, function () {
                        $('#company_ssn').html(suggestion.data.inn);
                        $('#company_name').html(suggestion.data.name.full_with_opf);
                        $('#company_address').html(suggestion.data.address.value);
                        $('#company_state').removeClass().html(
                            suggestionMachine.stateEnum[suggestion.data.state.status]
                        ).addClass('com-' + suggestion.data.state.status);
                        suggestionMachine.checkSSN(suggestion.data.inn);
                    });
                },
                'checkSSN': function (inputSsn = '') {
                    if (inputSsn.length === 0) return false;
                    $.ajax({
                        url: '{{ route('companies.check') }}',
                        type: 'GET',
                        data: {
                            ssn: inputSsn
                        },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (typeof response.company === 'object' && response.company !== null) {
                                suggestionMachine.showError(
                                    "<a href=\"" + response.company.url + "\">Организация #" + response.company.ssn +
                                    "</a> уже добавлена в систему.",
                                    '', 'lock'
                                );
                            }
                            $('#company_founded').slideDown(200);
                        }
                    });
                    return false;
                }
            };

            async function getJsonData(selectName) {
                let classifieds = {
                    'statuses': '{{ route('json.classifieds.company.statuses') }}'
                };
                if (typeof classifieds[selectName] !== 'undefined') {
                    try {
                        let response = await fetch(classifieds[selectName]);
                        let data = await response.json();
                        return data.data;
                    } catch (error) {
                        alert(error);
                    }
                }
            }

            window.getJsonData = getJsonData;

            let getJsonDataOLd = function (selectName) {
                let classifieds = {
                    'statuses': '{{ route('json.classifieds.company.statuses') }}'
                };
                var responseData = [];
                if (typeof classifieds[selectName] !== 'undefined') {
                    responseData = fetch(classifieds[selectName])
                        .then(response => response.json())
                        .then(data => responseData = data)
                }
                console.log(responseData);
                return responseData;
            }
        </script>
    </x-slot>

</x-app-layout>
