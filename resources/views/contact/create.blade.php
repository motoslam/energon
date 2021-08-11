<x-app-layout title="Новый контакт" wrapper_css="wrapper-create">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Новый контакт</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="form-contragent-wrap">
        <div class="container">
            <form action="{{ route('contacts.store') }}" method="post" class="contragent-form">
                @csrf
                @include('contact.form')
            </form>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function onlyDigit(char) {
                return [48, 49, 50, 51, 52, 53, 53, 54, 55, 56, 57, 32, 43].includes(char);
            }
        </script>
    </x-slot>

</x-app-layout>
