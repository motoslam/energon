<x-app-layout>

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('dashboard') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Добавление контрагента</div>
                    <div class="search">
                        <input type="search" id="searchBySSN"
                               placeholder="Поиск организаций по названию, ИНН, ОГРН и КПП"
                               autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="form-contragent-wrap">
        <div class="container">
            <form action="{{ route('companies.store') }}" class="contragent-form" method="post"
                  onsubmit="return checkCompanyIfAvailable(true);">
                @csrf
                <div class="contragent-form__item contragent-form__item50">
                    <label for="company_name">Название организации</label>
                    <input type="text" id="company_name" name="name"
                           class="@error('name') error @enderror"
                           autocomplete="off" value="{{ old('name') }}"
                    />
                </div>
                <div class="contragent-form-box">
                    <div class="contragent-form__item">
                        <label for="ssn">ИНН</label>
                        <input type="text" id="ssn" name="ssn" class="@error('ssn') error @enderror"
                               value="{{ old('ssn') }}"/>
                    </div>
                    <div class="contragent-form__item">
                        <label for="legal">Правовая форма</label>
                        <input type="text" id="legal" name="legal" value="{{ old('legal') }}">
                    </div>
                    <div class="contragent-form__item">
                        <label for="city">Город</label>
                        <select name="city" id="city" class="@error('city') error @enderror">
                            <option value="" disabled selected data-display=" ">Выберите город из списка</option>
                            @foreach($citiesList as $cityItem)
                                <option value="{{ $cityItem->id }}"
                                        data-fiasId="{{ $cityItem->fias_id }}">
                                    {{ $cityItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="contragent-form__item">
                        <label for="address">Адрес</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}">
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
                        <label for="description">Описание компании</label>
                        <textarea name="description" id="description">{{ old('description') }}</textarea>
                    </div>

                    <input type="hidden" name="checked" id="checked" value="false" />

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

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery.suggestions.min.js') }}"></script>
        <script src="{{ asset('js/swal.min.js') }}"></script>
        <script>
            $("#searchBySSN").suggestions({
                token: "a6f4b8b9573f6f8b55da539b89887e9ba4167f9a",
                type: "PARTY",
                onSelect: function (suggestion) {
                    $('#company_name').val(suggestion.data.name.full);
                    $('#ssn').val(suggestion.data.inn);
                    $('#legal').val(suggestion.data.opf.short);
                    $('#address').val(suggestion.data.address.value);
                    let fiasId = suggestion.data.address.data.city_fias_id;
                    if ($('#city [data-fiasId="' + fiasId + '"]').length) {
                        $('#city option:selected').attr('selected', false);
                        $('#city [data-fiasId="' + fiasId + '"]').attr('selected', true);
                        $('#city').niceSelect('update');
                    }
                    if(!checkCompanyIfAvailable()) {
                        // вывести предупреждение
                    }
                }
            });
            let legalForms = [
                'ГУП', 'МУУП', 'ДП', 'ПК', 'СХК', 'ООО',
                'ОАО', 'ЗАО', 'ГУЧ', 'МУЧ', 'АНО', 'АО', 'ИП'
            ];
            $('#legal').autocomplete({
                minChars: 2,
                maxHeight: 410,
                lookupLimit: 5,
                lookup: legalForms
            });

            let checkCompanyIfAvailable = function (thrownError = false) {
                let ssn = $('#ssn').val(),
                    result = true;
                $.ajax({
                    url: '{{ route('companies.check') }}',
                    type: 'GET',
                    data: { ssn : ssn },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if(!data.status) {
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
                        }
                    },
                    error: function() {
                        console.log('Что-то пошло не так...');
                        result = false;
                    }
                });

                return result;
            }

            //bounds: "city-settlement",

            /**
             *
             * NA STRANICU SPISKA:
             *
             *

             let addedCompany = $.load('route');
             $('#searchAddedCompany').autocomplete({
            minChars: 2,
            maxHeight: 410,
            lookupLimit: 13,
            lookup: contractors
         });

             *
             * */
        </script>
    </x-slot>

</x-app-layout>
