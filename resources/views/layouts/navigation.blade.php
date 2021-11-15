<header class="header">
    <div class="header-box">
        <a href="{{ url('/') }}" class="logo">
            <x-application-logo alt="Zavod Energon CRM" />
        </a>
        <ul class="menu">
            <x-nav-link :href="route('companies.index')" :active="request()->routeIs(['companies.*'])">
                Контрагенты
            </x-nav-link>
            <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                Планировщик
            </x-nav-link>
            <x-nav-link :href="route('stats.index')" :active="request()->routeIs('stats.*')">
                Статистика
            </x-nav-link>
        </ul>
        <div class="profile_a">
            <div class="profile-name">
                <b>{{ Auth::user()->name }}</b>
                <span>{{ Auth::user()->role->name }}</span>
            </div>
            <div class="profile-image sys-profile-image">
                <x-profile-image :photo="Auth::user()->photo" />
            </div>
            <div class="profile-hide">
                <a href="{{ route('alerts.index') }}" class="note-link">Уведомления</a>
                <a href="{{ route('contacts.index') }}" class="contact-book">Контакты</a>
                <a href="{{ route('settings.index') }}" class="settings-link">Настройки</a>
                @if(auth()->user()->role_id == 1)
                <a href="{{route('admin.index')}}" class="lk-link sys-admin-link">Управление</a>
                @endif
                <a href="{{ route('logout') }}" class="log-out-link"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Выйти
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
