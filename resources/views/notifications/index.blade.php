<x-app-layout title="Уведомления" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container-compatibility">
                <a href="{{ route('companies.index') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Уведомления (2)</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-compatibility">
        <div class="notice-item notice-item-new">
            <div class="notice-item-heading">
                <div class="notice-item-title">
                    Новая задача
                </div>
                <div class="notice-item-date">
                    12.12.2021 в 12:30
                </div>
            </div>
            <div class="notice-item-body">
                Вам пришло сообщение:
            </div>
        </div>

        <div class="notice-item">
            <div class="notice-item-heading">
                <div class="notice-item-title">
                    Новая задача
                </div>
                <div class="notice-item-date">
                    12.12.2021 в 12:30
                </div>
            </div>
            <div class="notice-item-body">
                Вам пришло сообщение:
            </div>
        </div>

        <div class="notice-pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </div>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </div>

</x-app-layout>
