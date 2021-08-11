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

    {{--
    <div class="elem-item-title">Связанные организации</div>
    <div class="elem-item-list">

        <div class="elem-item-box">
            <div class="elem-item-box-title">OOO “Smit-Yarcevo”</div>
            <div class="el-org">
                <span>ИНН</span>
                <b>6727014649</b>
            </div>
            <div class="el-org">
                <span>Адрес</span>
                <b>301650, Тульская область, г. Новомосковск,
                    ул. Калинина, д. 15</b>
            </div>
            <div class="btn-more-box">
                <a class="btn-more" href="javascrirpt:void(0)">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="btn-el-items">
                    <a href="#" class="btn-el btn-del"></a>
                    <a href="#" class="btn-el btn-edit"></a>
                </div>
            </div>
        </div>
        <div class="elem-item-box">
            <div class="elem-item-box-title">OOO “Sk STROY”</div>
            <div class="el-org">
                <span>ИНН</span>
                <b>7733306088</b>
            </div>
            <div class="el-org">
                <span>Адрес</span>
                <b>115580, Москва, ул. Шипиловская, д. 58, оф. 1</b>
            </div>
            <div class="btn-more-box">
                <a class="btn-more" href="javascript:void(0)">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="btn-el-items">
                    <a href="#" class="btn-el btn-del"></a>
                    <a href="#" class="btn-el btn-edit"></a>
                </div>
            </div>
        </div>
        <a href="#" class="add-card"><span>Добавить</span><i></i></a>
    </div>--}} <!-- Связанные организации -->
</div>
