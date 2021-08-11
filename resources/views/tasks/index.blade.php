<x-app-layout title="Планировщик" wrapper_css="">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('dashboard') }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="plans-box">
                <div class="plans-box__left">
                    <div class="plans-calendar"></div>

                    <div class="plans-request" id="objToStick">
                        <div class="plans-request-info" id="toForm">
                            <div class="plans-request-img"><img src="img/request-ico.svg" alt=""></div>
                            <div class="plans-request-title">Новая заметка</div>
                            <div class="plans-request-desc">Добавленная заметка отображается в блоке *планировщика
                                справа, через него вы можете редактировать текущие заметки или смещаь время их
                                реализации на другой срок
                            </div>
                            <a href="#" class="btn-blue">Добавить</a>
                        </div>

                        <div class="plans-request-form">
                            <div class="title">Добавить</div>
                            <form action="/" method="POST" class="form-request">
                                <div class="form-request__item">
                                    <label for="">Заголовок</label>
                                    <input type="text">
                                </div>
                                <div class="form-request__item">
                                    <label for="">Описание</label>
                                    <textarea name="" id="message-request"></textarea>
                                </div>
                                <div class="form-request__item">
                                    <label for="">Приоритет</label>
                                    <div class="priority-box">
                                        <label class="priority priority-middle" for="middle"><input type="radio"
                                                                                                    name="input-priorites"
                                                                                                    id="middle">
                                            <span><i></i></span></label>
                                        <label class="priority priority-low" for="low"><input type="radio"
                                                                                              name="input-priorites"
                                                                                              id="low">
                                            <span><i></i></span></label>
                                        <label class="priority priority-high" for="high"><input type="radio"
                                                                                                name="input-priorites"
                                                                                                id="high"> <span><i></i></span></label>

                                    </div>


                                </div>
                                <div class="form-request__item">
                                    <label for="">Дата</label>
                                    <input class="date-request" type="datetime-local">
                                </div>
                                <div class="dates-request">
                                    <input type="time" id="time-to">
                                </div>
                                <button class="btn-blue">Добавить</button>
                            </form>

                        </div>
                    </div>


                </div>
                <div class="plans-box__right">
                    <a href="#toForm" class="add-card"><span>Добавить</span><i></i></a>
                    <div class="dates-plans scrollbar-outer">
                        <div class="date-plan-item">
                            <div class="title">15 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item yellow">
                                    <div class="time">
                                        <div class="time-start">08:00</div>
                                        <div class="time-finish">09:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Перезвонить клиенту 15.03.2020</div>
                                        <div class="desc-note">Счет #95762 оплатили, перезвонить через неделю по поводу
                                            доставки
                                        </div>
                                    </div>
                                </div>

                                <div class="date-note-item green">
                                    <div class="time">
                                        <div class="time-start">10:00</div>
                                        <div class="time-finish">11:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo consequat.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo
                                        </div>
                                    </div>
                                </div>

                                <div class="date-note-item red">
                                    <div class="time">
                                        <div class="time-start">15:00</div>
                                        <div class="time-finish">16:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Duis aute irure dolor in reprehenderit in voluptate velit
                                            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                                            est
                                            laborum.
                                        </div>
                                        <div class="desc-note">Excepteur sint occaecat cupidatat non proident, sunt in
                                            culpa qui officia deserunt mollit anim id est laborum
                                        </div>
                                    </div>
                                </div>

                                <div class="date-note-item green">
                                    <div class="time">
                                        <div class="time-start">16:00</div>
                                        <div class="time-finish">17:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Sed ut perspiciatis unde omnis iste natus error sit
                                            voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                            quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                            explicabo.
                                        </div>
                                        <div class="desc-note">Doloremque laudantium, totam rem aperiam</div>
                                    </div>
                                </div>

                                <div class="date-note-item yellow">
                                    <div class="time">
                                        <div class="time-start">17:00</div>
                                        <div class="time-finish">18:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo consequat.
                                        </div>
                                        <div class="desc-note">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">16 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item green">
                                    <div class="time">
                                        <div class="time-start">08:00</div>
                                        <div class="time-finish">11:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum
                                            fugiat quo voluptas nulla pariatur, quis nostrud exercitation ullamco
                                            laboris
                                            nisi ut aliquip, sunt in culpa qui officia deserunt mollit anim id est
                                            laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">17 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item yellow">
                                    <div class="time">
                                        <div class="time-start">12:00</div>
                                        <div class="time-finish">14:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum
                                            fugiat quo voluptas nulla pariatur, quis nostrud exercitation ullamco
                                            laboris
                                            nisi ut aliquip, sunt in culpa qui officia deserunt mollit anim id est
                                            laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo, Quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo, Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">18 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item red">
                                    <div class="time">
                                        <div class="time-start">18:00</div>
                                        <div class="time-finish">20:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, quis nostrud exercitation
                                            ullamco laboris nisi ut aliquip, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">19 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item green">
                                    <div class="time">
                                        <div class="time-start">18:00</div>
                                        <div class="time-finish">20:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, quis nostrud exercitation
                                            ullamco laboris nisi ut aliquip, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">20 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item green">
                                    <div class="time">
                                        <div class="time-start">18:00</div>
                                        <div class="time-finish">20:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, quis nostrud exercitation
                                            ullamco laboris nisi ut aliquip, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="date-plan-item">
                            <div class="title">21 Марта</div>
                            <div class="date-notes">
                                <div class="date-note-item yellow">
                                    <div class="time">
                                        <div class="time-start">18:00</div>
                                        <div class="time-finish">20:00</div>
                                    </div>
                                    <div class="date-note-desc">
                                        <div class="name-note">Quis autem vel eum iure reprehenderit qui in ea voluptate
                                            velit esse quam nihil molestiae consequatur, quis nostrud exercitation
                                            ullamco laboris nisi ut aliquip, sunt in culpa qui officia deserunt mollit
                                            anim id est laborum.
                                        </div>
                                        <div class="desc-note">Quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
