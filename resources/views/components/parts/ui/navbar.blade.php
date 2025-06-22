<div id="navbar"
    class="bg-dark w-full h-[90px] flex items-center justify-center duration-300 border-b border-white/40 border-dashed">
    <div class="safearea justify-between">
        <x-ui.button onclick="showmenu()" class='lg:hidden' text='' iconclass='ri-menu-line' size='sm' />
        <a href="{{ route('ui.home') }}" wire:navigate>
            <x-ui.logo class='w-auto h-[30px] md:h-[35px]' />
        </a>
        <x-parts.ui.menu />
        @php
            $btnText = Auth::check() ? 'ড্যাশবোর্ড দেখুন' : 'লগ ইন / সাইন আপ';
        @endphp
        <x-ui.button class='hidden lg:flex min-w-fit' href='ui.login' text='{{ $btnText }}' />
        <x-ui.button class='lg:hidden' text='' href='ui.login' iconclass='ri-user-3-line' size='sm' />
    </div>
</div>
