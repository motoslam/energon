<x-app-layout title="Задача: {{ $task->name }}" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="message-box">
                <div class="message-box__left">
                    <div class="request-info">
                        @if($task->from_admin)
                            <div class="request-info__item">
                                <span>Постановщик</span>
                                <b>Руководитель отдела</b>
                            </div>
                        @endif
                        <div class="request-info__item">
                            <span>Контрагент</span>
                            <b>{{ $task->company->name }}</b>
                        </div>
                        <div class="request-info__item">
                            <span>Дата постановки</span>
                            <b>{{ $task->created_at->diffForHumans() }}</b>
                        </div>
                        <div class="request-info__item">
                            <span>Ответственный менеджер</span>
                            <b>{{ $task->user->name }}</b>
                        </div>
                        <div class="request-info__item">
                            <span>Статус</span>
                            <b>{{ $task->task_status_id }}</b>
                        </div>
                        <div class="request-info__item">
                            <span>Дедлайн</span>
                            <b>{{ $task->deadline_at->addHours($task->timer)->format('d.m.Y H:i') }}</b>
                        </div>
                        <div class="request-info__item">
                            <span>Приоритет</span>
                            <b>{{ $task->priority }}</b>
                        </div>
                    </div>
                </div>
                <div class="message-box__right">
                    <div class="request-messages">
                        <div class="request-messages-top">
                            <b>Задача #{{ $task->id }}</b>
                            <div class="title">{{ $task->name }}</div>
                            <div class="desc">{{ $task->content }}</div>
                            <div class="request-messages-date">
                                <label for="">Дата завершения</label>
                                <input type="text" class="data-messages">
                            </div>
                        </div>



                        <form action="/" class="form-message" id="message-form" method="post">
                            <label class="add-files">
                                <input type="file">
                                <span></span>
                            </label>

                            <textarea name="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore e</textarea>
                            <button class="send-message" type="submit"></button>
                        </form>

                        <div class="messages-box">
                            <div class="messages-box__item">
                                <div class="messages-box__item-name">Admin</div>
                                <div class="messages-box__item-text"><a href="#">https://www.figma.com/file/Q93glI21FwHorw2hSxxgbt/TASK-BOOK?node-id=270%3A814</a>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                    mollit anim id est laborum.
                                </div>
                                <div class="messages-box__item-date">
                                    <b>12:23 / 12.05.2020</b>
                                    <span>Просмотрено</span>
                                </div>
                            </div>

                            <div class="messages-box__item messages-box__item-you">
                                <div class="messages-box__item-name">Admin</div>
                                <div class="messages-box__item-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.
                                </div>
                                <div class="messages-box__item-date">
                                    <b>12:23 / 12.05.2020</b>
                                    <span>Просмотрено</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
