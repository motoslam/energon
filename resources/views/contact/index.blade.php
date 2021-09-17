<x-app-layout title="Контакты" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container-compatibility">
                <a href="{{ route('companies.index') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Контакты</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-compatibility">
        <div class="ss-container contacts-list">
            <livewire:contact.search />
        </div>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </div>

</x-app-layout>
