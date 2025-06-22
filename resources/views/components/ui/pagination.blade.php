@if ($paginator->hasPages())
    <nav class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-1 text-sm">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <x-ui.button text="« পূর্ববর্তী" class="pointer-events-none cursor-not-allowed" disabled variant="action-primary" size="xsm" />
            @else
                <li>
                    <x-ui.button text="« পূর্ববর্তী" size="xsm" wire:click="previousPage" />
                </li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max($paginator->currentPage() - 2, 1);
                $end = min($paginator->currentPage() + 2, $paginator->lastPage());
            @endphp

            @if ($start > 1)
                <li>
                    <x-ui.button :text="1" size="xsm" wire:click="gotoPage(1)" />
                </li>
                @if ($start > 2)
                    <li class="px-2 text-gray-400">...</li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <x-ui.button :text="$i" size="xsm" class="pointer-events-none cursor-not-allowed" disabled variant="action-primary" />
                @else
                    <li>
                        <x-ui.button :text="$i" size="xsm" wire:click="gotoPage({{ $i }})" />
                    </li>
                @endif
            @endfor

            @if ($end < $paginator->lastPage())
                @if ($end < $paginator->lastPage() - 1)
                    <li class="px-2 text-gray-400">...</li>
                @endif
                <li>
                    <x-ui.button :text="$paginator->lastPage()" size="xsm" wire:click="gotoPage({{ $paginator->lastPage() }})" />
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <x-ui.button text="পরবর্তী »" size="xsm" wire:click="nextPage" />
                </li>
            @else
                <x-ui.button text="পরবর্তী »" class="pointer-events-none cursor-not-allowed" disabled variant="action-primary" size="xsm" />
            @endif

        </ul>
    </nav>
@endif
