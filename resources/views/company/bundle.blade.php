<x-app-layout title="Новый контрагент" wrapper_css="wrapper-create">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">
                        Связанная организация
                        <div class="bundle-subtitle">
                            контрагент
                            <a href="{{ route('companies.show', ['company' => $company]) }}">
                                {{ $company->full_name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="bundle-box">
                <div class="bundle-box-column">
                    <div class="bundle-box-tile">
                        <div class="bundle-title">Выбрать из добавленных ранее организаций:</div>
                        <livewire:company.bundle-from-contragent :contragent="$company"/>
                    </div>
                </div>
                <div class="bundle-box-column">
                    <div class="bundle-box-tile">
                        <div class="bundle-title">Добавить новую организацию</div>
                        <div>
                            <form action="{{ route('companies.binding', ['company' => $company]) }}"
                                  method="post" autocomplete="off">
                                @csrf
                                <div class="bundle-search">
                                    <div class="bundle-search-icon">
                                        <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z"
                                                stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="bundle-search-input">
                                        <input type="text" id="searchBySSN"
                                               autocomplete="false"
                                               placeholder="Поиск организаций по названию, ИНН, ОГРН и КПП"/>
                                    </div>
                                </div>
                                <div class="bundle-result">
                                    @if ($errors->any())
                                        <div class="message-form message-error"
                                             style="margin-left: 0; margin-bottom: 25px">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif
                                    <input type="hidden" id="name" name="name" value="{{ old('name') }}"/>
                                    <input type="hidden" id="ssn" name="ssn" value="{{ old('ssn') }}"/>
                                    <input type="hidden" id="city" name="city" value="{{ old('city') }}"/>
                                    <input type="hidden" id="legal" name="legal" value="{{ old('legal') }}"/>
                                    <input type="hidden" id="address" name="address" value="{{ old('address') }}"/>
                                    <input type="hidden" id="state" name="state" value="{{ old('state') }}"/>
                                    <div class="found-company" id="company_founded"
                                         @if (!$errors->any()) hidden @endif >
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
                                    <div class="sys-flex-right">
                                        <button type="submit" class="btn-blue btn-blue-sys-fix">
                                            Добавить и связать организации
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery.suggestions.min.js') }}"></script>
        <script src="{{ asset('js/swal.min.js') }}"></script>
        <script>

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
                if ($('#ssn').val() === '') {
                    $('#searchBySSN').addClass('error');
                    return false;
                }
                if (!$('#company_type').val() ||
                    !$('#company_purchase').val() ||
                    !$('#company_status').val() ||
                    !$('#company_potentiality').val()) {

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
                } else {
                    $(btn).closest('form').submit();
                }
                return false;
            }

        </script>
    </x-slot>

</x-app-layout>
