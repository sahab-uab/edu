<div class="py-2 overflow-y-auto h-[calc(100%-60px)]">
    <ul>
        @foreach ($menulist as $index => $item)
            <li class="py-2 px-4 relative transition-all {{ in_array(Route::currentRouteName(), $item['current']) ? 'bg-gray-50/10' : '' }} hover:bg-gray-50/10 group"
                onclick="toggleclass('#submenu{{ $index }}', ['hidden'])">

                <!-- Main Menu -->
                <a href="{{ !empty($item['sub']) ? 'javascript:void(0);' : $item['url'] ?? '#' }}"
                    @if (empty($item['sub'])) wire:navigate @endif class="flex items-center justify-between">
                    <div class="flex items-center gap-x-2 text-white group-hover:text-primary">
                        <i
                            class="{{ $item['icon'] ?? '' }} text-lg transition-colors group-hover:text-primary mb-[2px]"></i>
                        <span class="text-base font-semibold transition-colors group-hover:text-primary">
                            {{ $item['text'] }}
                        </span>
                    </div>
                    @if (!empty($item['sub']))
                        <i
                            class="ri-arrow-down-s-line text-white ml-2 group-hover:text-primary transition-transform group-hover:rotate-180"></i>
                    @endif
                </a>

                <!-- Sub Menu -->
                @if (!empty($item['sub']))
                    <ul class="pl-3 mt-1 space-y-1 {{ in_array(Route::currentRouteName(), $item['current']) ? '' : 'hidden' }}"
                        id="submenu{{ $index }}">
                        @foreach ($item['sub'] as $subitem)
                            <li class="py-1 px-4 transition-all">
                                <a href="{{ $subitem['url'] ?? '#' }}" wire:navigate
                                    class="flex items-center gap-x-2 {{ Route::currentRouteName() == $subitem['current'] ? 'text-primary' : 'text-white' }} hover:text-primary">
                                    <span class="text-base font-semibold">
                                        {{ $subitem['text'] }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
