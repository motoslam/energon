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

                    <livewire:company.create-task />

                </div>
                <div class="plans-box__right">
                    {{--<a href="#toForm" class="add-card"><span>Добавить</span><i></i></a>--}}
                    <livewire:task.index :model="$user" />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
