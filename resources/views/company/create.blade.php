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

    <div class="container">
        <div class="sys-form-company">
            <div class="sys-form-company-search">
                <div class="sys-form-company_col">
                    <label for="search">
                        1. Поиск организаций и индивидуальных предпринимателей по названию, ИНН, КПП,
                        ФИО руководителя, адресу до улицы.
                    </label>
                    <input type="search" id="search" placeholder="" autocomplete="off" autofocus/>
                </div>
            </div>

            @if ($errors->any())
                <div class="message-form message-error" style="margin-left: 0; margin-bottom: 25px">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="sys-form-company-inputs" style="display: none" id="form">
                <form action="{{ route('companies.store') }}" method="post"
                      onsubmit="return createCompanyValidate(this);" id="createForm">
                    @csrf
                    <div class="sys-form-company_row">
                        <div class="sys-form-company_col">
                            <label for="name">2. Корректировка полученных данных</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}">
                            <span class="sys-form-help">
                                Название организации без организационно-правовой формы
                            </span>
                        </div>
                    </div>
                    <div class="sys-form-company_row sys-form-company_row--md">
                        <div class="sys-form-company_col">
                            <label for="ssn_v">ИНН</label>
                            <input type="text" id="ssn_v" name="ssn_v" disabled
                                   value="{{ old('ssn') }}">
                            <input type="hidden" id="ssn" name="ssn" value="{{ old('ssn') }}">
                            <input type="hidden" id="city" name="city" value="{{ old('city') }}"/>
                        </div>
                        <div class="sys-form-company_col">
                            <label for="legal">Правовая форма</label>
                            <input type="text" id="legal" name="legal" value="{{ old('legal') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="address">Адрес</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="sys-form-company_row sys-form-company_row--md">
                        <div class="sys-form-company_col">
                            <label for="company_type">Тип контрагента</label>
                            <select name="company_type" id="company_type"
                                    class="@error('company_type') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите тип контрагента</option>
                                @foreach($companyTypes as $companyType)
                                    <option value="{{ $companyType->id }}">{{ $companyType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sys-form-company_col">
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
                        <div class="sys-form-company_col">
                            <label for="company_status">Статус контрагента</label>
                            <select name="company_status" id="company_status"
                                    onchange="toggleAdditionFields($(this).val())"
                                    class="@error('company_status') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите статус контрагента</option>
                                @foreach($companyStatuses as $companyStatus)
                                    <option value="{{ $companyStatus->id }}">{{ $companyStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sys-form-company_col">
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
                    </div>
                    <div class="sys-form-company_row">
                        <div class="sys-form-company_col">
                            <label for="description">Краткое описание</label>
                            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="sys-form-company_row js-additional-fields" style="display: none">
                        <div class="sys-form-company_col">
                            <div class="contragent-form__item_info">
                                <span>
                                    Следующие данные будут отображены только для
                                    контрагентов, имеющих статус "Действующий"
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="sys-form-company_row sys-form-company_row--md js-additional-fields" style="display: none">
                        <div class="sys-form-company_col">
                            <label for="contract">№ Договора</label>
                            <input type="text" name="contract" id="contract" @error('contract') error @enderror
                            value="{{ old('contract') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="specification">№ Спецификации</label>
                            <input type="text" name="specification" id="specification"
                                   @error('specification') error @enderror
                                   value="{{ old('specification') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="offer_number">№ Заявки</label>
                            <input type="text" name="offer_number" id="offer_number" @error('offer_number') error @enderror
                            value="{{ old('offer_number') }}">
                        </div>
                    </div>
                    <div class="sys-form-company_row sys-form-company_row--md js-additional-fields" style="display: none">
                        <div class="sys-form-company_col">
                            <label for="order_number">№ Заказа</label>
                            <input type="text" name="order_number" id="order_number" @error('order_number') error @enderror
                            value="{{ old('order_number') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="order_date">Дата заказа</label>
                            <input type="date" name="order_date" id="order_date" @error('order_date') error @enderror
                            value="{{ old('order_date') }}" class="datepick">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="order_total">Сумма заказа</label>
                            <input type="text" name="order_total" id="order_total"
                                   @error('order_total') error @enderror
                                   value="{{ old('order_total') }}">
                        </div>
                    </div>
                    <div class="sys-form-company_row sys-form-company_row--md js-additional-fields" style="display: none">
                        <div class="sys-form-company_col">
                            <label for="manager_bonus">% Премии менеджера</label>
                            <input type="text" name="manager_bonus" id="manager_bonus"
                                   @error('manager_bonus') error @enderror
                            value="{{ old('manager_bonus') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="working_hours">Кол-во рабочих часов</label>
                            <input type="text" name="working_hours" id="working_hours"
                                   @error('working_hours') error @enderror
                            value="{{ old('working_hours') }}">
                        </div>
                        <div class="sys-form-company_col">
                            <label for="equipment">Тип оборудования</label>
                            <input type="text" name="equipment" id="equipment"
                                   @error('equipment') error @enderror
                            value="{{ old('equipment') }}">
                        </div>
                    </div>
                    <div class="sys-form-company-buttons">
                        <button class="sbtn sbtn-blue" type="submit">Добавить организацию</button>
                        <button class="sbtn sbtn-white" type="button">Отмена</button>
                        <div class="message-form message-error message-inline" style="display: none" id="errMessage"></div>
                    </div>
                </form>
            </div>
            <div class="sys-form-company-error" style="display: none" id="error">
                <div class="message-form message-lock" id="errorMessage"></div>
                <button class="sbtn sbtn-blue" type="button"
                        onclick="$('#createForm').submit()">
                    Запросить передачу организации
                </button>
                <button class="sbtn sbtn-white" type="button">Отмена</button>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery.suggestions.min.js') }}"></script>
        <script>
            autosize(document.querySelectorAll('textarea'));

            $("#search").suggestions({
                token: "a6f4b8b9573f6f8b55da539b89887e9ba4167f9a",
                type: "PARTY",
                minChars: 3,
                scrollOnFocus: true,
                onSelect: function (suggestion) {
                    onSelectCompany(suggestion);
                },
                onSelectNothing: function (query) {

                }
            });

            function onSelectCompany(company) {
                if(company.data.type == 'INDIVIDUAL') {
                    if(company.data.name.full == null) {
                        $('#name').val(company.data.name.short_with_opf);
                    } else {
                        $('#name').val(company.data.name.full);
                    }
                } else {
                    if (company.data.name.short == null) {
                        $('#name').val(company.data.name.short_with_opf);
                    } else {
                        $('#name').val(company.data.name.short);
                    }
                }
                $('#ssn_v').val(company.data.inn);
                $('#ssn').val(company.data.inn);
                $('#legal').val(company.data.opf.short);
                $('#address').val(company.data.address.value);
                getCityByFiasId(company.data.address.data.city_fias_id);
                checkSSN(company.data.inn);
            }

            function getCityByFiasId(fias_id) {
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

            function checkSSN(inputSsn = '') {
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
                        console.log(response);
                        if (typeof response.company === 'object' && response.company !== null) {
                            $('#errorMessage').html('Организация ' + response.company.name +
                                ' уже добавлена в систему');
                            $('#error').slideDown(200);
                        } else {
                            $('#form').slideDown(200);
                        }
                    }
                });
                return false;
            }

            function toggleAdditionFields(value) {
                if (value == 2 || value == 3) {
                    $('.js-additional-fields').show();
                } else {
                    $('.js-additional-fields').hide();
                }
            }

            function createCompanyValidate(form) {
                $('#errMessage').hide();
                let error = false;
                let errMessage = '';
                if($('#name').val().trim() == '') {
                    $('#name').addClass('error');
                    error = true;
                    errMessage = 'Название не может быть пустым';
                }
                if(error){
                    $('#errMessage').html(errMessage);
                    $('#errMessage').fadeIn();
                }
                return !error;
            }

        </script>
    </x-slot>

</x-app-layout>
