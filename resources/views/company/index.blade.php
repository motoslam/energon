<x-app-layout title="Контрагенты" wrapper_css="">

    <x-slot name="header">
        <div class="content-box__top-line">
            <div class="container">
                <h1>Контрагенты</h1>
                <a href="{{ route('companies.create') }}" class="sys-header-button">
                    <span>Добавить организацию</span><img src="img/plus-blue.svg" alt="">
                </a>
                <div class="filters">
                    <livewire:company.search />
                    <div class="filters-right">
                        <div class="select-box">
                            <span>Статус:</span>
                            <select name="company_status_id"
                                    onchange="Livewire.emit('statusUpdated', this.value)">
                                <option value="">Все</option>
                                @foreach($companyStatuses as $cStatus)
                                    <option value="{{ $cStatus->id }}">{{ $cStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <livewire:company.abc />
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <livewire:company.index />

</x-app-layout>
