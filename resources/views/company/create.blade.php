<x-app-layout title="Новый контрагент" wrapper_css="wrapper-create">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('companies.index') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Новый контрагент</div>
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
                        <input type="search" id="searchBySSN" @error('ssn') error @enderror
                               placeholder=""
                               autocomplete="off">
                    </div>
                    @if ($errors->any())
                        <div class="message-form message-error" style="margin-left: 0; margin-bottom: 25px">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="found-company" id="company_founded" @if (!$errors->any()) hidden @endif >
                        <div class="found-company-closed" id="company_error" hidden>
                            <div class="message-form message-lock" id="company_error_message"></div>
                        </div>
                        <div class="found-company-item">
                            <span>Название организации</span>
                            <b id="company_name">{{ old('name') ?? '—' }}</b>
                        </div>
                        <div class="found-company-item">
                            <span>ИНН</span>
                            <b id="company_ssn">{{ old('ssn') ?? '—' }}</b>
                        </div>
                        <div class="found-company-item">
                            <span>Адрес</span>
                            <b id="company_address">{{ old('address') ?? '—' }}</b>
                        </div>
                        <div class="found-company-item">
                            <span>Статус организации</span>
                            <b id="company_state">{{ old('state') ?? '—' }}</b>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-contragent-wrap form-contragent-wrap-no-border-radius">
            <div class="container">

                <form action="{{ route('companies.store') }}" class="contragent-form" method="post">
                    @csrf

                    <input type="hidden" id="name" name="name" value="{{ old('name') }}"/>
                    <input type="hidden" id="ssn" name="ssn" value="{{ old('ssn') }}"/>
                    <input type="hidden" id="city" name="city" value="{{ old('city') }}"/>
                    <input type="hidden" id="legal" name="legal" value="{{ old('legal') }}"/>
                    <input type="hidden" id="address" name="address" value="{{ old('address') }}"/>
                    <input type="hidden" id="state" name="state" value="{{ old('state') }}"/>

                    <div class="contragent-form-box">
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
                        <div class="contragent-form__item">
                            <label for="company_status">Статус контрагента</label>
                            <select name="company_status" id="company_status"
                                    class="@error('company_status') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите статус контрагента</option>
                                @foreach($companyStatuses as $companyStatus)
                                    <option value="{{ $companyStatus->id }}">{{ $companyStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
                            <button type="button" class="btn-blue"
                                    onclick="checkFieldsBeforeSubmit(this)">Создать контрагента</button>
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
                        getCityByFiasId(suggestion.data.address.data.city_fias_id);
                        collectCompanyData(suggestion);
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
                                    "Организация <a href=\"" + response.company.url + "\">#" + response.company.ssn +
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

            let getCityByFiasId = function (fias_id) {
                if (!fias_id) return false;
                fetch('{{ route('json.classifieds.cities.find') }}?fias_id=' + fias_id)
                    .then(response => response.json())
                    .then((result) => {
                        if (result.status) {
                            $('#city').val(result.data.id);
                        }
                    });
                return true;
            }

            let collectCompanyData = function (suggestion) {
                $('#company_ssn').html(suggestion.data.inn);
                $('#company_name').html(suggestion.data.name.full_with_opf);
                $('#company_address').html(suggestion.data.address.value);
                $('#company_state').removeClass().html(
                    suggestionMachine.stateEnum[suggestion.data.state.status]
                ).addClass('com-' + suggestion.data.state.status);

                $('#ssn').val(suggestion.data.inn);
                $('#name').val(suggestion.data.name.short_with_opf);
                $('#legal').val(suggestion.data.opf.short);
                $('#address').val(suggestion.data.address.unrestricted_value);
                $('#state').val(suggestionMachine.stateEnum[suggestion.data.state.status]);
                return true;
            }

            function checkFieldsBeforeSubmit(btn) {
                if($('#ssn').val() === '') {
                    $('#searchBySSN').addClass('error');
                    return false;
                }
                if ( !$('#company_type').val() ||
                     !$('#company_purchase').val() ||
                     !$('#company_status').val() ||
                     !$('#company_potentiality').val() ) {

                    Swal.fire({
                        title: 'Это все?',
                        text: "Некоторые поля не заполнены, и им будет присвоено значение по умолчанию",
                        icon: 'question',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Создать контрагента',
                        cancelButtonText: 'Отмена',
                        confirmButtonColor: '#2E5BFF',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(btn).closest('form').submit();
                        }
                    })
                }
                return false;
            }

        </script>
    </x-slot>

</x-app-layout>
