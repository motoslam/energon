<x-app-layout title="Новый контрагент" wrapper_css="wrapper-create">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Связанная организация</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="plans-box">
                <div class="plans-box__left">
                    <div class="plans-request">
                        <div class="plans-request-form" x-data>
                            <div class="title">Выбрать из своих организаций</div>
                            <form action="{{ route('companies.binding', ['company' => $company]) }}"
                                  method="post" x-ref="formone">
                                @csrf
                                <div class="form-request__item sys-custom-select clearfix"
                                     style="margin-bottom: 26px;">
                                    <select name="exist_company" id="exist_company">
                                        <option value="" selected disabled>Список организаций</option>
                                        @foreach($companies as $companyItem)
                                            <option value="{{ $companyItem->id }}">{{ $companyItem->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-request__item">
                                    <button type="submit" class="btn-blue" @click="$refs.formone.submit">Cвязать организации</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="plans-box__right">
                    <div class="dates-plans scrollbar-outer sys-fix-title">
                        <div class="date-plan-item">
                            <div class="title quote">или добавить новую</div>
                            <div class="date-notes">
                                <form action="{{ route('companies.binding', ['company' => $company]) }}"
                                      method="post">
                                    @csrf
                                    <div class="sys-fix-input">
                                        <input type="search" id="searchBySSN" @error('ssn') error @enderror
                                        placeholder="Поиск организаций по названию, ИНН, ОГРН и КПП"
                                               autocomplete="off">
                                    </div>
                                    @if ($errors->any())
                                        <div class="message-form message-error" style="margin-left: 0; margin-bottom: 25px">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif
                                    <input type="hidden" id="name" name="name" value="{{ old('name') }}"/>
                                    <input type="hidden" id="ssn" name="ssn" value="{{ old('ssn') }}"/>
                                    <input type="hidden" id="city" name="city" value="{{ old('city') }}"/>
                                    <input type="hidden" id="legal" name="legal" value="{{ old('legal') }}"/>
                                    <input type="hidden" id="address" name="address" value="{{ old('address') }}"/>
                                    <input type="hidden" id="state" name="state" value="{{ old('state') }}"/>
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
                                    <div class="sys-flex-right">
                                        <button type="submit" class="btn-blue btn-blue-sys-fix">
                                            Добавить и связать организации
                                        </button>
                                    </div>
                                </form>
                            </div>
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
                }else{
                    $(btn).closest('form').submit();
                }
                return false;
            }

        </script>
    </x-slot>

</x-app-layout>
