<div class="fixed top-0 left-0 w-full h-full backdrop-blur-md flex items-center justify-center z-[1000] duration-300 {{ $model == 'false' ? 'opacity-0 pointer-events-none' : '' }} p-6"
    wire:click='{{ $bodyClose == 'true' ? $controller : '' }}'>
    <div class="bg-white rounded-base overflow-hidden border border-gray-200 shadow-lg" style="width: {{ $cardSize }}">
        @if ($headerfalse == 'false')
            <header
                class="p-4 border-b gap-4 border-gray-100 flex {{ $modelSubTitle ? 'items-start' : 'items-center' }} justify-between">
                <div>
                    <h1 class="text-base font-semibold">{{ $modelTitle }}</h1>
                    @if ($modelSubTitle)
                        <small class="text-gray-500 text-sm">{{ $modelSubTitle }}</small>
                    @endif
                </div>
                <x-ui.button wire:click='{{ $controller }}' text='' iconclass='ri-close-line' size='xsm'
                    variant='action-primary' />
            </header>
        @endif
        <div class="{{ $bodyClass }}">
            {{ $slot }}
        </div>
    </div>
</div>
