<div class="messages-box" wire:poll.10s="callUpdate">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    @if($messages->count() == 0)
        <div class="messages-box__empty">Пока что никто ничего не написал</div>
    @endif

    @foreach($messages as $message)
        <livewire:chat.message-item :message="$message" :wire:key="$message->id"/>
    @endforeach

</div>
