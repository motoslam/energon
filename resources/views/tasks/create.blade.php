<x-app-layout title="Новая задача" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ url()->previous() }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Новая задача</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="form-contragent-wrap">
        <div class="container">
            <form action="{{ route('tasks.store') }}" method="post" class="contragent-form">
                @csrf
                @include('tasks.form')
            </form>
        </div>
    </div>

    <x-slot name="scripts">
        <script>

        </script>
    </x-slot>

</x-app-layout>
