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

    <div x-data="{show: {{ in_array($company->companyStatus->id, [2,3]) ? 'true' : 'false' }}}">
        <div class="form-contragent-wrap-search">
            <div class="container">
                <form action="#" method="post" class="contragent-form" onsubmit="return false;">
                    <livewire:company.detail-info-on-edit :company="$company" :show="Auth::user()->show_detail_company" />
                </form>
            </div>
        </div>
        <div class="form-contragent-wrap form-contragent-wrap-no-border-radius">
            <div class="container">

                <form action="{{ route('companies.update', ['company' => $company]) }}"
                      class="contragent-form" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="contragent-form-box">
                        <div class="contragent-form__item">
                            <label for="company_type">Тип контрагента</label>
                            <select name="company_type" id="company_type"
                                    class="@error('company_type') error @enderror">
                                <option value="" disabled data-display=" ">Выберите тип контрагента</option>
                                @foreach($companyTypes as $companyType)
                                    <option value="{{ $companyType->id }}"
                                        {{ $company->company_type_id == $companyType->id ? 'selected' : '' }}
                                    >{{ $companyType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contragent-form__item">
                            <label for="company_purchase">Тип закупки</label>
                            <select name="company_purchase" id="company_purchase"
                                    class="@error('company_purchase') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите тип закупки</option>
                                @foreach($companyPurchases as $companyPurchase)
                                    <option value="{{ $companyPurchase->id }}"
                                        {{ $company->company_purchase_id == $companyPurchase->id ? 'selected' : '' }}
                                    >
                                        {{ $companyPurchase->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contragent-form__item">
                            <label for="company_status">Статус контрагента</label>
                            <select name="company_status" id="company_status"
                                    onchange="toggleAdditionFields($(this).val())"
                                    class="@error('company_status') error @enderror">
                                <option value="" disabled selected data-display=" ">Выберите статус контрагента</option>
                                @foreach($companyStatuses as $companyStatus)
                                    <option value="{{ $companyStatus->id }}"
                                        {{ $company->company_status_id == $companyStatus->id ? 'selected' : '' }}
                                    >{{ $companyStatus->name }}</option>
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
                                    <option value="{{ $companyPotentiality->id }}"
                                        {{ $company->potentiality_id == $companyPotentiality->id ? 'selected' : '' }}
                                    >
                                        {{ $companyPotentiality->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contragent-form__item big contragent-form-border-bottom">
                            <label for="description">Краткое описание</label>
                            <textarea name="description" id="description"
                                      rows="4">{{ old('description') ?? $company->description  }}</textarea>
                        </div>
                    </div>
                    <div class="contragent-form-box js-additional-fields" x-show="show" x-cloak>
                        <div class="contragent-form__item big contragent-form__item_info">
                            <span>Следующие данные будут отображены только для контрагентов, имеющих статус "Действующий"</span>
                        </div>
                    </div>
                    <div class="contragent-form-box js-additional-fields contragent-form-border-bottom" x-show="show" x-cloak>
                        <div class="contragent-form__item">
                            <label for="contract">№ Договора</label>
                            <input type="text" name="contract" id="contract" @error('contract') error @enderror
                                   value="{{ old('contract') ?? $company->contract }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="specification">№ Спецификации</label>
                            <input type="text" name="specification" id="specification"
                                   @error('specification') error @enderror
                            value="{{ old('specification') ?? $company->specification }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="offer_number">№ Заявки</label>
                            <input type="text" name="offer_number" id="offer_number" @error('offer_number') error @enderror
                            value="{{ old('offer_number') ?? $company->offer_number }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="order_number">№ Заказа</label>
                            <input type="text" name="order_number" id="order_number" @error('order_number') error @enderror
                            value="{{ old('order_number') ?? $company->order_number }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="order_date">Дата заказа</label>
                            <input type="text" name="order_date" id="order_date" @error('order_date') error @enderror
                            value="{{ old('order_date') ?? $company->order_date }}" class="datepick">
                        </div>

                        <div class="contragent-form__item">
                            <label for="order_total">Сумма заказа</label>
                            <input type="text" name="order_total" id="order_total"
                                   @error('order_total') error @enderror
                                   value="{{ old('order_total') ?? $company->order_total }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="manager_bonus">% Премии менеджера</label>
                            <input type="text" name="manager_bonus" id="manager_bonus" @error('manager_bonus') error @enderror
                            value="{{ old('manager_bonus') ?? $company->manager_bonus }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="working_hours">Кол-во рабочих часов</label>
                            <input type="text" name="working_hours" id="working_hours" @error('working_hours') error @enderror
                            value="{{ old('working_hours') ?? $company->working_hours }}">
                        </div>

                        <div class="contragent-form__item">
                            <label for="equipment">Тип оборудования</label>
                            <input type="text" name="equipment" id="equipment" @error('equipment') error @enderror
                            value="{{ old('equipment') ?? $company->equipment }}">
                        </div>
                    </div>
                    <div class="contragent-form-box">
                        <div class="form-btns edit-form-btns">
                            <button type="button" class="btn-cancel"
                                    onclick="window.location.href='{{ route('companies.show', ['company' => $company]) }}'"
                                    style="margin-right: 20px">Отмена</button>
                            <button type="submit" class="btn-blue">Сохранить изменения</button>
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
            let toggleAdditionFields = function(value){
                if(value == 2 || value == 3){
                    $('.js-additional-fields').show();
                } else {
                    $('.js-additional-fields').hide();
                }
            }

            autosize(document.querySelectorAll('textarea'));

            let toggleShowDetail = function(){
                $('#company_founded').slideToggle(200);
                if($('#showDetailInfoCheckbox').checked) {
                    $('#showDetailInfoCheckbox').prop("checked", false);
                } else{
                    $('#showDetailInfoCheckbox').prop("checked", true);
                }
            }

            $('.datepick').datepicker({});
        </script>
    </x-slot>

</x-app-layout>
