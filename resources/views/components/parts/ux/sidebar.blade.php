<div class="min-w-[230px] fixed md:static z-[99] -left-full duration-300 min-h-full bg-dark shadow" id="sidebar" wire:ignore>
    {{-- header --}}
    <div class="flex items-center justify-between px-4 h-[50px] border-b border-gray-200 border-dotted">
        <x-ui.logo variant='light' class="h-[24px] w-auto"/>
        <x-ui.button text='' iconclass='ri-close-line' size='xsm' onclick="sidebarcollaps()" class="flex md:hidden"/>
    </div>
    {{-- header end --}}

    {{-- menu --}}
    <x-parts.ux.sidebar-menu/>
    {{-- menu end --}}
</div>