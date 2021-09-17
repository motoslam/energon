<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="bundle-search">
        <div class="bundle-search-icon">
            <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18"
                 fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z"
                    stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="bundle-search-input">
            <input type="text" placeholder="Поиск организаций в списке контрагентов"
                   autocomplete="off" wire:model="searchQuery"/>
        </div>
    </div>
    <div class="bundle-list">
        @foreach($companies as $company)
            <div class="bundle-item">
                <div class="bundle-item-item-col bundle-item-name">
                    <b>{{ $company->legal }}</b>
                    <span>{{ $company->name }}</span>
                </div>
                <div class="bundle-item-item-col bundle-item-status" wire:ignore>
                    <livewire:elements.status :status="$company->companyStatus" />
                </div>
                <div class="bundle-add-btn">
                    <a href="javascript:void(0);" wire:click.prevent="attach({{ $company->id }})">Связать с контрагентом</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
