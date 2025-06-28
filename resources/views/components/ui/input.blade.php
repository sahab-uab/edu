<div>
    @php
        $class =
            ($textarea == 'true' ? 'min-h-[80px] p-3' : ($size == 'sm' ? 'h-[30px] text-sm' : 'h-[40px] text-base')) .
            ' w-full duration-300 placeholder:text-gray-500 placeholder:text-sm outline-0 flex items-center px-3 border border-gray-200 rounded-base focus:border-primary' .
            ($type == 'password' ? 'pr-[42px]' : '');
    @endphp
    @error($target)
        @php
            $class =
                ($textarea == 'true'
                    ? 'min-h-[100px] p-3'
                    : ($size == 'sm'
                        ? 'h-[30px] text-sm'
                        : 'h-[40px] text-base')) .
                ' w-full duration-300 placeholder:text-gray-500 placeholder:text-sm outline-0 flex items-center px-3 border border-red-200 rounded-base focus:border-primary' .
                ($type == 'password' ? 'pr-[42px]' : '');
        @endphp
    @enderror
    @if ($label)
        <label class="text-base text-dark">{{ $label }}</label>
    @endif
    <div class="relative w-full flex items-center justify-between mt-1">
        @if ($textarea == 'true')
            <textarea {{ $attributes->merge(['class' => $class]) }} placeholder="{{ $hint }}"></textarea>
        @else
            @if ($type == 'file')
                <label for="{{ $id }}" class="w-full border-2 border-dotted flex items-center justify-center duration-300 hover:border-primary border-gray-200 rounded-base p-4">
                    <p class="text-base font-semibold text-gray-600">ছবি বাছায় করুন</p>
                    <input id="{{ $id }}" {{ $attributes->merge() }} class='hidden' type="{{ $type }}">
                </label>
            @else
                <input {{ $attributes->merge(['class' => $class]) }} type="{{ $type }}"
                    placeholder="{{ $hint }}">
            @endif
        @endif
        @if ($type == 'password')
            <button type="button" onclick="toggleInput(this)"
                class="absolute right-0 cursor-pointer text-gray-500  h-[40px] w-[40px] flex items-center justify-center">
                <i class="ri-eye-line"></i>
            </button>
        @endif
    </div>
    @error($target)
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
