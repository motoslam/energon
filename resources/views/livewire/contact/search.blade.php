<div class="ss-table-search">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="ss-table-search-box">
        <div class="ss-table-search-box-icon">
            <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18"
                 fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z"
                    stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <input type="text" placeholder="Найти контакт по имени, номеру телефона или E-mail"
               wire:model="searchQuery" autocomplete="off"/>
    </div>
    <div class="ss-table-search-table">
        <table>
            <thead>
            <tr>
                <th style="max-width: 55px;">ID</th>
                <th>Фамилия Имя Отчество</th>
                <th>Должность</th>
                <th style="min-width: 160px;">Номер телефона</th>
                <th style="min-width: 160px;">Адрес электронной почты</th>
                <th>Организация</th>
                <th style="min-width: 115px;">Добавлен</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @forelse($contacts as $contact)
                <tr class="ss-table-search-table-collapsed" x-data="{ open: false, btnText: 'Подробнее' }"
                    :class="open ? 'ss-table-search-table-uncollapsed' : ''"
                    x-init="$watch('open', value => value ? btnText='Свернуть' : btnText='Подробнее')">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->position }}</td>
                    <td class="nopadding">
                        <div class="linkblock">
                            @foreach($contact->phones as $phone)
                                <a href="tel:{{ $phone->data }}">{{ $phone->data }}</a>
                            @endforeach
                        </div>
                    </td>
                    <td class="nopadding">
                        <div class="linkblock">
                            @foreach($contact->emails as $email)
                                <a href="tel:{{ $email->data }}">{{ $email->data }}</a>
                            @endforeach
                        </div>
                    </td>
                    <td class="nopadding">
                        <a href="{{ route('companies.show', $contact->company) }}">{{ $contact->company->full_name }}</a>
                    </td>
                    <td>17.09.2021</td>
                    <td class="nopadding2" style="width: 170px">
                        @if($contact->phones->count() > 1 or $contact->emails->count() > 1)
                        <a href="javascript:void(0);" class="ss-table-btn"
                           @click="open = !open"><span x-text="btnText">Развернуть</span></a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="ss-table-help">
                        Контакты не найдены.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
