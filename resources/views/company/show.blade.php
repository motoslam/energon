<x-app-layout>

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('dashboard') }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="info-item-top">
                <div class="info-item-top__left">
                    <div class="info-item-title">
                        <b>
                            {{ $company->legal }}
                            {{ $company->name }}
                        </b>
                        <div class="info-item-title-box">
                            <span class="in-work2">Проработка</span>
                        </div>

                        <div class="client-status">
                            <div class="select-box">
                                <span>Потенциал клиента:</span>
                                <select name="select-potential" id="select-potential">
                                    @foreach($companyPotentialities as $companyPotential)
                                        <option value="{{ $companyPotential->id }}">
                                            {{ $companyPotential->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- TODO: Ссылки нажимаются даже когда не видны -->
                        <div class="btn-more-box">
                            <a class="btn-more" href="javascript:void(0)">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <div class="btn-el-items">
                                <a href="#" class="btn-el btn-del"></a>
                                <a href="#" class="btn-el btn-edit"></a>
                            </div>
                        </div>

                    </div>
                    <div class="info-item-content">
                        <p>{{ $company->description }}</p>
                    </div>
                    <div class="info-item-address">
                        <div>
                            <span>ИНН</span>
                            <b>{{ $company->ssn }}</b>
                        </div>
                        <div>
                            <span>Город</span>
                            <b>{{ $company->city->name }}</b>
                        </div>
                        @if($company->address)
                            <div>
                                <span>Адрес</span>
                                <b>{{ $company->address }}</b>
                            </div>
                        @endif
                    </div>
                </div>
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
                        <span>Статус клиента</span>
                        <b>{{ $company->companyStatus->name }}</b>
                    </div>
                    <div class="item-info">
                        <span>Ответственный менеджер </span>
                        <b>{{ $company->user->name }}</b>
                    </div>
                    <div class="btn-more-box">
                        <a class="btn-more" href="javascrirpt:void(0)">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <div class="btn-el-items">
                            <a href="#" class="btn-el btn-del"></a>
                            <a href="#" class="btn-el btn-edit"></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TODO: Вывести следующий блок когда будет понятна логика
            При статусе клиента «действующий - разовый» и «действующий – постоянный», выводить
            у контрагента: № Договора, № Спецификации, № Заявки, № Заказа, Дата заказа, Сумма заказов, %
            Премии менеджера, Кол-во рабочих часов, Тип оборудования.
            -->

            <x-company-contract :company="$company" />

        </div>
    </div>
    <div class="elem-information">
        <div class="container">
            <div class="elem-information__btns">
                <a href="javascript:void(0)" class="btn-switch" data-switch="tab_1">Лента событий</a>
                <a href="javascript:void(0)" class="btn-switch active" data-switch="tab_2">Контакты</a>
                <a href="javascript:void(0)" class="btn-switch" data-switch="tab_3">Задачи</a>
            </div>
            <a href="javascript:void(0)" class="btn-filter"><span>Фильтр</span></a>
            <div class="elem-information__box">
                <div class="elem-item" id="tab_1" style="display: none;">
                    <div class="events-box">
                        <div class="events-items">
                            <div class="new-event-box" style="display: none;">
                                <div class="new-event-box__top">
                                    <div class="new-event-date">Сегодня, 14:37</div>
                                    <a href="#">Отменить</a>
                                </div>
                                <form action="/" method="post" class="form-new-task events-item task new-task green">

                                    <div class="title">Новое событие</div>
                                    <div class="form-new-task__box">
                                        <div class="form-new-task__item">
                                            <label for="">Название события</label>
                                            <input type="text" value="Заказ">
                                        </div>
                                        <div class="form-new-task__item">
                                            <label for="">Дата</label>
                                            <input type="text" class="date-new-event" value="">
                                        </div>
                                    </div>
                                    <div class="form-new-task__item">
                                        <label for="">Контактное лицо</label>
                                        <input type="text" value="Резник Евгений Александрович">
                                    </div>
                                    <div class="form-new-task__item">
                                        <label for="">Основания </label>
                                        <textarea name="">Являясь всего лишь частью общей картины, независимые государства, вне зависимости от их уровня, должны быть функционально разнесены</textarea>
                                    </div>
                                    <button class="btn-blue">Создать</button>
                                </form>
                            </div>

                            <div class="events-item task">
                                <div class="events-item-date">Сегодня, 14:37</div>
                                <div class="events-item-title">Поставлена задача: Перезвонить клиенту 12.08.2017</div>
                                <div class="events-item-info">
                                    <div class="events-item-info-status">Заказ</div>
                                    <div class="events-item-info-note">
                                        <b>2 дня назад</b>
                                        <span>Счет #95762 оплатили, перезвонить через неделю по поводу доставки</span>
                                    </div>
                                    <div class="events-item-info-person">
                                        <b>Контактное лицо</b>
                                        <span>Резник Евгений Александрович</span>
                                    </div>
                                </div>
                            </div>

                            <div class="events-item request">
                                <div class="events-item-date">Сегодня, 14:37</div>
                                <div class="events-item-title">Заявка: Перезвонить клиенту 12.08.2017</div>
                                <div class="events-item-info">
                                    <div class="events-item-info-status">Заявка</div>
                                    <div class="events-item-info-note">
                                        <b>2 дня назад</b>
                                        <span>Отправил счет на заказ #95762</span>
                                    </div>
                                    <div class="events-item-info-person">
                                        <b>Контактное лицо</b>
                                        <span>Резник Евгений Александрович</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="events-dates">
                            <a href="#" class="btn-new-event"><span>Добавить событие</span><img src="img/plus-blue.svg"
                                                                                                alt=""></a>
                            <div class="select-box">
                                <span>Категория:</span>
                                <select name="" id="">
                                    <option value="Телефонный звонок">Телефонный звонок</option>
                                    <option value="Заказ">Заказ</option>
                                    <option value="Заявка">Заявка</option>
                                    <option value="Заявка">Задача</option>
                                </select>
                            </div>
                            <div class="date-range">
                                <div class="date-range-item">
                                    <input placeholder="С" class="start_one" data-multiple-dates-separator=" - "
                                           type="text" class="date" id="datepicker">
                                </div>
                                <div class="date-range-item">
                                    <input placeholder="По" type="text" class="date end_one">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elem-item" id="tab_2">
                    <div class="elem-item-title">Сотрудники</div>
                    <div class="elem-item-list">

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Резник Евгений Александрович</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 903 028 30 90</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:rea@megavatt-lip.ru">rea@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Руководитель отдела закупок</span>
                                <b>Королева Ольга Ивановна</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 903 031 93 42</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:koroleva.avr@gmail.com">koroleva.avr@gmail.com</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Дешевых Константин Сергеевич</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 960 141 82 06</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:dks@megavatt-lip.ru">dks@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Шемякин Андрей</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79042816843">+7 904 281 68 43</a></b>
                                </div>
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+7 962 351 25 50">+7 962 351 25 50</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Руководитель отдела закупок</span>
                                <b>Пашков Владимир Николаевич</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030287435">+7 903 028 74 35</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:pvn@megavatt-lip.ru">pvn@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="add-card"><span>Добавить</span><i></i></a>
                    </div>


                    <div class="elem-item-title">Связанные организации</div>
                    <div class="elem-item-list">

                        <div class="elem-item-box">
                            <div class="elem-item-box-title">OOO “Smit-Yarcevo”</div>
                            <div class="el-org">
                                <span>ИНН</span>
                                <b>6727014649</b>
                            </div>
                            <div class="el-org">
                                <span>Адрес</span>
                                <b>301650, Тульская область, г. Новомосковск,
                                    ул. Калинина, д. 15</b>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <div class="elem-item-box">
                            <div class="elem-item-box-title">OOO “Sk STROY”</div>
                            <div class="el-org">
                                <span>ИНН</span>
                                <b>7733306088</b>
                            </div>
                            <div class="el-org">
                                <span>Адрес</span>
                                <b>115580, Москва, ул. Шипиловская, д. 58, оф. 1</b>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="add-card"><span>Добавить</span><i></i></a>
                    </div>
                </div>
                <div class="elem-item" id="tab_3" style="display: none;">
                    <div class="elem-item-title">Сотрудникииииии</div>
                    <div class="elem-item-list">

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Резник Евгений Александрович</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 903 028 30 90</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:rea@megavatt-lip.ru">rea@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Руководитель отдела закупок</span>
                                <b>Королева Ольга Ивановна</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 903 031 93 42</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:koroleva.avr@gmail.com">koroleva.avr@gmail.com</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Дешевых Константин Сергеевич</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030283090">+7 960 141 82 06</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:dks@megavatt-lip.ru">dks@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Начальник коммерческого отдела</span>
                                <b>Шемякин Андрей</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79042816843">+7 904 281 68 43</a></b>
                                </div>
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+7 962 351 25 50">+7 962 351 25 50</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>

                        <div class="elem-item-box">
                            <div class="elem-item-box__top">
                                <span>Руководитель отдела закупок</span>
                                <b>Пашков Владимир Николаевич</b>
                            </div>
                            <div class="elem-item-box__bottom">
                                <div>
                                    <span>Номер телефона</span>
                                    <b><a href="tel:+79030287435">+7 903 028 74 35</a></b>
                                </div>
                                <div>
                                    <span>Электронная почта</span>
                                    <b><a href="mailto:pvn@megavatt-lip.ru">pvn@megavatt-lip.ru</a></b>
                                </div>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="add-card"><span>Добавить</span><i></i></a>
                    </div>


                    <div class="elem-item-title">Связанные организации</div>
                    <div class="elem-item-list">

                        <div class="elem-item-box">
                            <div class="elem-item-box-title">OOO “Smit-Yarcevo”</div>
                            <div class="el-org">
                                <span>ИНН</span>
                                <b>6727014649</b>
                            </div>
                            <div class="el-org">
                                <span>Адрес</span>
                                <b>301650, Тульская область, г. Новомосковск,
                                    ул. Калинина, д. 15</b>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <div class="elem-item-box">
                            <div class="elem-item-box-title">OOO “Sk STROY”</div>
                            <div class="el-org">
                                <span>ИНН</span>
                                <b>7733306088</b>
                            </div>
                            <div class="el-org">
                                <span>Адрес</span>
                                <b>115580, Москва, ул. Шипиловская, д. 58, оф. 1</b>
                            </div>
                            <div class="btn-more-box">
                                <a class="btn-more" href="javascrirpt:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="btn-el-items">
                                    <a href="#" class="btn-el btn-del"></a>
                                    <a href="#" class="btn-el btn-edit"></a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="add-card"><span>Добавить</span><i></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            let VarGoodNight = 1;
        </script>
    </x-slot>

</x-app-layout>
