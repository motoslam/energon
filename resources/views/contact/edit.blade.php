<x-app-layout title="Редактировать: {{ $contact->name }}" wrapper_css="wrapper-create">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Редактировать: {{ $contact->name }}</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="form-contragent-wrap">
        <div class="container">
            <form action="{{ route('contacts.update', ['contact' => $contact]) }}" method="post" class="contragent-form">
                @csrf
                @method('PATCH')
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
