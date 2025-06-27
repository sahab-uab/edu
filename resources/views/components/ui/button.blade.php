@php
    $classes =
        'btn ' .
        ($variant == 'primary' ? 'btn-primary ' : '') .
        ($variant == 'secondary' ? 'btn-secondary ' : '') .
        ($variant == 'action' ? 'btn-action ' : '') .
        ($variant == 'action-primary' ? 'btn-action-primary ' : '') .
        $class .
        ' ' .
        ($size == 'sm' ? 'py-1.5 px-3' : '') .
        ($size == 'xsm' ? 'py-1 px-2' : '');
@endphp

@if ($href)
    <a wire:navigate href="{{ route($href) }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($iconposition == 'left')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
        {{ $text }}
        @if ($iconposition == 'right')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
    </a>
@elseif ($route)
    <a wire:navigate href="{{ $route }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($iconposition == 'left')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
        {{ $text }}
        @if ($iconposition == 'right')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
    </a>
@else
    <button wire:target='{{ $target }}' wire:loadng.att='disabled' type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}>
        @if ($iconposition == 'left')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
        @if ($text)
            <span wire:loading.remove wire:target='{{ $target }}'>{{ $text }}</span>
        @endif
        @if ($iconposition == 'right')
            @if ($iconclass)
                <i class="{{ $iconclass }}" wire:loading.remove wire:target='{{ $target }}'></i>
            @endif
        @endif
        <i class="ri-loader-2-line animate-spin duration-700" wire:loading wire:target='{{ $target }}'></i>
    </button>
@endif
