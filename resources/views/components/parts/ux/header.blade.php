<div class="w-full min-h-[50px] bg-white flex items-center justify-between gap-3 px-4">
    <div class="flex items-center gap-3">
        <x-ui.button text='' size='xsm' iconclass='ri-menu-line' onclick="sidebarcollaps()" class="md:hidden" />
        <h1 class="text-base font-semibold text-gray-500 hidden md:flex">{{ $title }}</h1>
    </div>
    <div class="flex items-center gap-3">
        <x-ui.button href='ui.home' text='সাইট এ যান' variant='action-primary' size='xsm' iconclass='ri-earth-line'
            iconposition='left' />

        {{-- profile --}}
        <div class="relative">
            <x-ui.button
                onclick="toggleclass('#profiledropdown', ['translate-y-5', 'pointer-events-none', 'opacity-0'])"
                text='' iconclass='ri-user-line' variant='action-primary' size='xsm' />

            <div id="profiledropdown"
                class="absolute translate-y-5 pointer-events-none opacity-0 duration-300 pb-1 min-w-[130px] top-full flex flex-col mt-6 bg-white rounded-base border border-gray-200 right-0 z-[30]">
                <div class="flex flex-col items-center gap-2 mb-2 p-3 bg-gray-50/50 rounded-base">
                    <img src="{{ Auth::user()->profile ? asset('storage/' . Auth::user()->profile) : get_media() }}"
                        class="w-7 h-7 object-cover border border-gray-300 rounded-base">
                    <div>
                        <p class="text-sm font-normal text-center">{{ Str::limit(Auth::user()->name, 10) }}</p>
                        <p class="text-sm font-normal text-center capitalize">
                            @if (Auth::user()->role == 'admin')
                                এডমিন
                            @elseif(Auth::user()->role == 'teacher')
                                শিক্ষক
                            @elseif(Auth::user()->role == 'student')
                                ছাত্র/ছত্রী
                            @elseif(Auth::user()->role == 'writer')
                                এডিটর
                            @else
                                অন্যান
                            @endif
                        </p>
                    </div>
                </div>

                <a href="{{ route('ux.profile.info') }}" wire:navigate
                    class="flex items-center gap-2 w-full px-3 py-2 text-gray-500 duration-300 hover:text-dark text-sm">
                    <i class="ri-user-line"></i>
                    <span>প্রোফাইল</span>
                </a>
                <a href="{{ route('ux.profile.security') }}" wire:navigate
                    class="flex items-center gap-2 w-full px-3 py-2 text-gray-500 duration-300 hover:text-dark text-sm">
                    <i class="ri-lock-star-line"></i>
                    <span>সিকিউরিটি</span>
                </a>
                <hr class="border-gray-100 my-1">
                <a href="{{ route('logout') }}" wire:navigate
                    class="flex items-center gap-2 w-full px-3 py-2 text-gray-500 duration-300 hover:text-red-500 text-sm">
                    <i class="ri-shut-down-line"></i>
                    <span>লগ-আউট</span>
                </a>
            </div>
        </div>
    </div>
</div>
