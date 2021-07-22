@props(['active'])

@php
$classes = ($active ?? false)
            ? 'active'
            : 'js-no-active';
@endphp

<li><a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a></li>
