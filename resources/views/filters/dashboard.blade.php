<div class="filters">
    <div class="search">
        <input type="search" id="search" placeholder="Поиск">
    </div>
    <div class="filters-right">
        <div class="select-box">
            <span>Статус:</span>
            <select name="company_status_id" id="company_status_id">
                <option value="0">Все</option>
                @foreach($companyStatuses as $cStatus)
                <option value="{{ $cStatus->id }}">{{ $cStatus->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="btn-abc"></div>
        <div class="alfavite">
            <div class="alfavite-box">
                <a href="#">А</a>
                <a href="#">Б</a>
                <a href="#">В</a>
                <a href="#">Г</a>
                <a href="#">Д</a>
                <a href="#">Е</a>
                <a href="#">Ё</a>
                <a href="#">Ж</a>
                <a href="#">З</a>
                <a href="#">И</a>
                <a href="#">Й</a>
                <a href="#">К</a>
                <a href="#">Л</a>
                <a href="#">М</a>
                <a href="#">Н</a>
                <a href="#">О</a>
                <a href="#">П</a>
                <a href="#">Р</a>
                <a href="#">С</a>
                <a href="#">Т</a>
                <a href="#">У</a>
                <a href="#">Ф</a>
                <a href="#">Х</a>
                <a href="#">Ц</a>
                <a href="#">Ч</a>
                <a href="#">Ш</a>
                <a href="#">Щ</a>
                <a href="#">Ъ</a>
                <a href="#">Ы</a>
                <a href="#">Ь</a>
                <a href="#">Э</a>
                <a href="#">Ю</a>
                <a href="#">Я</a>
            </div>
        </div>
        <div class="alfavite-select">
            <select name="alfavite-sel" id="alfavite-sel">
                <option value="A">А</option>
                <option value="Б">Б</option>
                <option value="В">В</option>
                <option value="Г">Г</option>
                <option value="Д">Д</option>
                <option value="Е">Е</option>
                <option value="Ё">Ё</option>
                <option value="Ж">Ж</option>
                <option value="З">З</option>
                <option value="И">И</option>
                <option value="Й">Й</option>
                <option value="К">К</option>
                <option value="Л">Л</option>
                <option value="М">М</option>
                <option value="Н">Н</option>
                <option value="О">О</option>
                <option value="П">П</option>
                <option value="Р">Р</option>
                <option value="С">С</option>
                <option value="Т">Т</option>
                <option value="У">У</option>
                <option value="Ф">Ф</option>
                <option value="Х">Х</option>
                <option value="Ц">Ц</option>
                <option value="Ч">Ч</option>
                <option value="Ш">Ш</option>
                <option value="Щ">Щ</option>
                <option value="Ъ">Ъ</option>
                <option value="Ы">Ы</option>
                <option value="Ь">Ь</option>
                <option value="Э">Э</option>
                <option value="Ю">Ю</option>
                <option value="Я">Я</option>
            </select>
        </div>
    </div>
</div>

