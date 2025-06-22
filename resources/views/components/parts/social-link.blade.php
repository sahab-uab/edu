<ul class="flex flex-wrap gap-2 items-center mt-5">
    @if ($socialLink)
        @foreach ($socialLink as $item)
            @php
                $icon = array_key_first($item);
                $url = $item[$icon];
            @endphp
            @if ($icon && $url)
                <li>
                    <a href="{{ $url }}" target="_blank"
                       class="bg-gray-100 flex items-center justify-center w-8 h-8 text-lg text-dark duration-300 hover:text-primary rounded-base">
                        <i class="ri {{ $icon }}"></i>
                    </a>
                </li>
            @endif
        @endforeach
    @endif
</ul>