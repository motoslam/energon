<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="elem-item-title">Контактные лица</div>
    <div class="elem-item-list">

        @foreach($contacts as $contact)
            <div class="elem-item-box">
                <div class="elem-item-box__top">
                    <span>{{ $contact->position ?? '—' }}</span>
                    <b>{{ $contact->name}}</b>
                </div>
                <div class="elem-item-box__bottom">
                    @foreach($contact->phones as $phone)
                        <div>
                            <span>Номер телефона</span>
                            <b><a href="tel:{{ $phone->data }}">{{ $phone->data }}</a></b>
                        </div>
                    @endforeach
                    @foreach($contact->emails as $email)
                        <div>
                            <span>Электронная почта</span>
                            <b><a href="mailto:{{ $email->data }}">{{ $email->data }}</a></b>
                        </div>
                    @endforeach
                </div>
                <div class="btn-more-box">
                    <a class="btn-more" href="javascrirpt:void(0)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <div class="btn-el-items">
                        <a href="javascript:void(0)" onclick="removeContact({{ $contact->id }})"
                           class="btn-el btn-del"></a>
                        <a href="{{ route('contacts.edit', ['contact' => $contact]) }}" class="btn-el btn-edit"></a>
                    </div>
                    <form action="{{ route('contacts.destroy', ['contact' => $contact]) }}"
                          method="post" id="removeContact{{ $contact->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @endforeach

        <a href="{{ route('contacts.create') }}?company={{ $company->ssn }}" class="add-card">
            <span>Добавить</span><i></i>
        </a>
    </div>


    <div class="elem-item-title">Связанные организации</div>
    <div class="elem-item-list">

        @foreach($links as $linkCompany)
        <div class="elem-item-box sys-no-select">
            <a href="{{ route('companies.show', ['company' => $linkCompany]) }}"
               class="elem-item-box-title sys-elem-item-box-title-a">
                {{ $linkCompany->name }}
            </a>
            <div class="el-org">
                <span>ИНН</span>
                <b>{{ $linkCompany->ssn }}</b>
            </div>
            <div class="el-org">
                <span>Адрес</span>
                <b>{{ $linkCompany->address }}</b>
            </div>
            <div class="btn-more-box">
                <a class="btn-more" href="javascript:void(0)">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="btn-el-items">
                    <a href="javascript:void(0);"
                       wire:click="loose({{ $linkCompany->id }}, {{ $company->id }})"
                       class="btn-el btn-unlink"></a>
                    <a href="#" class="btn-el btn-edit"></a>
                    <a href="#" class="btn-el btn-task"></a>
                </div>
            </div>
        </div>
        @endforeach

        <a href="{{ route('companies.bundle', ['company' => $company]) }}" class="add-card">
            <span>Добавить</span><i></i>
        </a>
    </div>
</div>
