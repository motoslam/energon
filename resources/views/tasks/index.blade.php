<x-app-layout title="Планировщик задач" wrapper_css="wrapper-vn wrapper-scroll-auto">

    <x-slot name="header">
        <div class="content-box__back-line">
            <div class="container">
                <a href="{{ route('companies.index') }}" class="back">Назад</a>
            </div>
        </div>
    </x-slot>

    <div class="content-box__info-item">
        <div class="container">
            <div class="plans-box" x-data="{calendar: {{ $user->tasks()->count() > 0 ? 'true' : 'false' }},
                btn: 'Добавить', success: true}">
                <div class="plans-box__left">
                    @if (session()->has('success'))
                        <livewire:task.success message="{{ session('success') }}" />
                    @else
                        <livewire:task.success />
                    @endif
                    <div class="plans-calendar" x-show.transition.scale="calendar" x-cloak></div>
                    <div class="plans-request" x-show.transition.scale="!calendar" x-cloak>
                        <livewire:task.create />
                    </div>
                </div>
                <div class="plans-box__right">
                    <a href="javascript:void(0)"
                       x-show.transition.scale="calendar" x-cloak
                       @click="calendar = !calendar; btn = (btn=='Добавить') ? 'Скрыть форму' : 'Добавить'"
                       class="add-card"><span x-text="btn">Добавить</span><i></i></a>
                    <livewire:task.index :model="$user" />
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            autosize(document.querySelectorAll('textarea'));

            Livewire.on('showSuccess', function(){
                let timerId = setInterval(function(){
                    Livewire.emit('hideSuccess');
                }, 10000);
            })
        </script>
    </x-slot>

</x-app-layout>
