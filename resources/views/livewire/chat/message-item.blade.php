<div class="messages-box__item {{ $isOwn ? 'messages-box__item-you' : '' }}">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="messages-box__item-name">{{ $message->user->name }}</div>
    <div class="messages-box__item-text">
        @if($message->attach)
            {{--<a href="{{ $attach_url }}" target="_blank">{{ $attach_url }}</a>--}}
        @endif
        {{ $message->body }}
    </div>
    <div class="messages-box__item-date">
        <b>{{ $message->created_at->diffForHumans() }}</b>
        @if($message->viewed)
            <span>Просмотрено</span>
        @endif
    </div>
</div>
