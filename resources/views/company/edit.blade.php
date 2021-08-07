<x-app-layout title="Редактирование: {{ $company->name }}" wrapper_css="wrapper-edit">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('companies.show', ['company' => $company]) }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Редактирование: {{ $company->name }}</div>
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
                    </div>
                </form>
            </div>
        </div>

        <div class="form-contragent-wrap form-contragent-wrap-no-border-radius">
            <div class="container">

                <form action="{{ route('companies.update', ['company' => $company]) }}" class="contragent-form"
                      method="post">
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
                        <div class="contragent-form__item">
                            <label for="company_status">Статус контрагента</label>
                            <select name="company_status" id="company_status"
                                    class="@error('company_status') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите статус контрагента</option>
                                @foreach($companyStatuses as $companyStatus)
                                    <option value="{{ $companyStatus->id }}">
                                        {{ $companyStatus->name }}
                                    </option>
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
                onSelect: function (suggestion) {
                    $('#company_founded').slideUp();
                    $('#company_ssn').html(suggestion.data.inn);
                    $('#company_name').html(suggestion.data.name.full_with_opf);
                    //$('#city').val(suggestion.data.address.city);
                    $('#company_address').html(suggestion.data.address.value);
                    let fiasId = suggestion.data.address.data.city_fias_id;
                    if (!checkCompanyIfAvailable(suggestion.data.inn)) {
                        $('#company_error_mesage')
                    }
                    $('#company_founded').slideDown();
                }
            });

            let checkCompanyIfAvailable = function (input_ssn) {
                let ssn = $(input_ssn).val();
                $.ajax({
                    url: '{{ route('companies.check') }}',
                    type: 'GET',
                    data: {ssn: ssn},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (!data.status) {
                            Swal.fire({
                                title: 'Упс...',
                                text: data.message,
                                icon: 'warning',
                                showConfirmButton: data.confirmButton,
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Продолжить',
                                cancelButtonText: 'Отмена',
                                reverseButtons: true
                            }).then((result) => {
                                result = result.isConfirmed;
                            });
                        } else {

                        }
                    },
                    error: function () {
                        console.log('Что-то пошло не так...');
                        result = false;
                    }
                });

                return result;
            };

        </script>
    </x-slot>

</x-app-layout>
