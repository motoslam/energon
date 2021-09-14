<div x-data="{letter: ''}" x-init="$watch('letter', value => changeLetter(value))">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="btn-abc"></div>
    <div class="alfavite">
        <div class="alfavite-box">
            @foreach(preg_split('//u', $letters, -1, PREG_SPLIT_NO_EMPTY) as $char)
            <a href="#" @click.prevent="changeLetter('{{ $char }}')">{{ $char }}</a>
            @endforeach
        </div>
    </div>
    <div class="alfavite-select">
        <select name="alfavite-sel" id="alfavite-sel">
            @foreach(preg_split('//u', $letters, -1, PREG_SPLIT_NO_EMPTY) as $char)
                <option value="{{ $char }}">{{ $char }}</option>
            @endforeach
        </select>
    </div>
    <script>
        function changeLetter(val) {
            if (val.length > 0) {
                document.getElementById('search').value = 'start:' + val;
                Livewire.emit('searchUpdated', 'start:' + val);
                toggleAbc();
            }
        }
    </script>
</div>
