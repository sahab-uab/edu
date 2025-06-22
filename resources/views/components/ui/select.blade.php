<div>
    @php
        $class =
            ($size == 'sm' ? 'h-[30px] text-sm' : 'h-[40px] text-base') .
            ' w-full duration-300 placeholder:text-gray-500 placeholder:text-sm outline-0 flex items-center px-3 border border-gray-200 rounded-base focus:border-primary';
    @endphp
    @error($target)
        @php
            $class =
                ($size == 'sm' ? 'h-[30px] text-sm' : 'h-[40px] text-base') .
                ' w-full duration-300 placeholder:text-gray-500 placeholder:text-sm outline-0 flex items-center px-3 border border-red-200 rounded-base focus:border-primary';
        @endphp
    @enderror
    @if ($label)
        <label class="text-base text-dark">{{ $label }}</label>
    @endif
    <div class="relative w-full flex items-center justify-between mt-1">
        <select {{ $attributes->merge(['class' => $class]) }}>
            <option value="" selected>--বাছায়--</option>
            @foreach ($dataoption as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    @error($target)
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
