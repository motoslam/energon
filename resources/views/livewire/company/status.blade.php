<div class="info-item-title-box">
    {{--git<select wire:model="status_id" name="status_id" id="status-select">
        <option selected disabled value="Статус">Статус</option>
        @foreach($companyStatuses as $cStatus)
            <option value="{{ $cStatus->id }}">{{ $cStatus->name }}</option>
        @endforeach
    </select>--}}
    <span class="in-work2">{{ $company->companyStatus->name }}</span>
</div>
