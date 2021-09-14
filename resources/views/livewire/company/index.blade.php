<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="table-wrap sys-pb-0">
        <div class="container">
            <div class="table">
                <div class="table-tr">
                    <div class="table-th sys-no-select">Организация</div>
                    <div class="table-th sys-no-select">Город</div>
                    <div class="table-th sys-no-select">Контактное лицо</div>
                    <div class="table-th sys-no-select">телефон</div>
                    <div class="table-th sys-no-select">E-mail</div>
                    <div class="table-th sys-no-select">ИНН</div>
                    <div class="table-th sys-no-select">тип клиента</div>
                    <div class="table-th sys-no-select">Статус</div>
                </div>

                @foreach($companies as $company)
                    <div class="table-tr" x-data>
                        <a href="{{ route('companies.show', ['company' => $company]) }}" class="table-td">
                            <b>{{ $company->legal ?? '—' }}</b>
                            <span>{{ $company->name }}</span>
                        </a>
                        <div class="table-td">
                            <b>{{ $company->city->region->short_fd ?? '—' }}</b>
                            <span>{{ $company->city->name }}</span>
                        </div>
                        <div class="table-td">
                            @foreach($company->contacts as $contact)
                                <b>{{ $contact->position ?? '-' }}</b>
                                <span>{{ $contact->name }}</span>

                            @endforeach
                        </div>
                        <div class="table-td">
                            @foreach($company->contacts as $contact)
                                @foreach($contact->phones as $phone)
                                    <b>Номер телефона</b>
                                    <span><a href="tel:{{ $phone->data }}">{{ $phone->data }}</a></span>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="table-td">
                            @foreach($company->contacts as $contact)
                                @foreach($contact->emails as $email)
                                    <b>Адрес электронной почты</b>
                                    <span><a href="mailto:{{ $email->data }}">{{ $email->data }}</a></span>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="table-td">
                            <b>ИНН</b>
                            <span>{{ $company->ssn }}</span>
                        </div>
                        <div class="table-td">
                            <b>Тип клиента</b>
                            <span>{{ $company->companyType->name }}</span>
                        </div>
                        <div class="table-td">
                            <div>
                                <a href="javascript:void(0)" class="in-work2"
                                   title="{{ $company->companyStatus->name }}">
                                    {{ $company->companyStatus->short_name }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if($companies->isEmpty())
                <div class="sys-company-not-found">Контрагенты не найдены</div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="sys-info">
            В списке {{ $companies->count() }} {{ trans_choice('messages.companies', $companies->count()) }}
        </div>
    </div>
</div>
