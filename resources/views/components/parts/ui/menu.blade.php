<div class="fixed lg:relative flex items-center lg:justify-center top-0 left-0 w-full h-full backdrop-blur-sm lg:backdrop-blur-none z-[999] pointer-events-none lg:pointer-events-auto duration-300 opacity-0 lg:opacity-100"
    id="menuoverly">
    {{-- for desktop --}}
    <ul class="hidden items-center gap-x-5 text-white lg:flex">
        @foreach ($menu as $label => $link)
            @if (is_array($link))
                <!-- Dropdown menu -->
                <li class="relative group">
                    <div class='flex items-center gap-x-1'>
                        <a href="#" class="text-base font-normal duration-300 hover:text-primary cursor-pointer">
                            {{ $label }}
                        </a>
                        <i class="ri-add-line text-sm group-hover:text-primary duration-300"></i>
                    </div>
                    <ul
                        class="absolute left-0 hidden py-2 bg-white rounded-base overflow-hidden group-hover:block min-w-[150px] shadow-lg z-10">
                        @foreach ($link as $sublabel => $sublink)
                            @php
                                $subDelay = ($loop->index + 1) * 100; // submenu delay starts at 100ms, 200ms, ...
                            @endphp
                            <li class="h-full">
                                <a href="{{ $sublink }}" wire:navigate
                                    class="block px-4 py-1 text-dark hover:text-primary">
                                    {{ $sublabel }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <!-- Single link -->
                <li>
                    <a href="{{ $link }}" wire:navigate
                        class="text-base font-normal duration-300 hover:text-primary">
                        {{ $label }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

    {{-- mobile --}}
    <ul id="menu"
        class="flex z-[999] lg:hidden flex-col bg-white w-[80%] md:w-[300px] h-full overflow-y-auto duration-300 -translate-x-full relative">
        {{-- header --}}
        <li>
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <x-ui.logo class='h-[30px] w-auto' variant='dark' />
                <x-ui.button size='sm' onclick="showmenu()" class='md:hidden' text=''
                    iconclass='ri-close-line' />
            </div>
        </li>
        <div class="overflow-y-auto">
            <ul>
                @foreach ($menu as $label => $link)
                    @if (is_array($link))
                        <!-- Dropdown menu -->
                        <li class="relative group">
                            <div class="border-b border-gray-100 py-3 px-4 flex items-center justify-between">
                                <a href="javascript:void(0);" onclick="togglesubmenu(this)"
                                    class="text-base w-full font-normal duration-300 hover:text-primary cursor-pointer">
                                    {{ $label }}
                                </a>
                                <i class="ri-arrow-down-s-fill"></i>
                            </div>
                            <ul class="bg-gray-100 p-4 hidden">
                                @foreach ($link as $sublabel => $sublink)
                                    @php
                                        $subDelay = ($loop->index + 1) * 100; // submenu delay starts at 100ms, 200ms, ...
                                    @endphp
                                    <li class="h-full">
                                        <a href="{{ $sublink }}" wire:navigate
                                            class="block px-4 py-1 text-dark hover:text-primary">
                                            {{ $sublabel }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <!-- Single link -->
                        <li class="border-b border-gray-100 py-3 px-4">
                            <a href="{{ $link }}" wire:navigate
                                class="text-base font-normal duration-300 hover:text-primary">
                                {{ $label }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <li class="absolute bottom-0 left-0 w-full p-4 bg-white">
            <div>
                <x-parts.social-link/>
                <ul class="flex items-center gap-3 flex-wrap mt-3">
                    <li><a href=""
                            class="text-sm text-primary duration-300 hover:underline hover:text-secondary">হোম</a></li>
                    <li><a href=""
                            class="text-sm text-primary duration-300 hover:underline hover:text-secondary">মেনু লিংক</a>
                    </li>
                    <li><a href=""
                            class="text-sm text-primary duration-300 hover:underline hover:text-secondary">গোপনীয়তা
                            লিংক</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
