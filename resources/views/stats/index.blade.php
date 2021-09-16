<x-app-layout title="Статистика" wrapper_css="wrapper-vn">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container-compatibility">
                <a href="{{ route('companies.index') }}" class="back">Назад</a>
                <div class="form-contragent-top">
                    <div class="title">Статистика</div>
                </div>
            </div>
        </div>
    </x-slot>

    <div>
        <!-- include tailwind -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <div class="container-compatibility">
            <table>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

</x-app-layout>
