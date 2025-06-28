<div class="mt-14">
    <div class="flex flex-col gap-3 overflow-hidden">
        <div class="left-slider flex gap-3">
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white w-[300px] flex flex-col">
                        <i class="ri-double-quotes-l text-3xl text-primary"></i>
                        <p class="text-sm text-gray-600 mt-4">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white w-[300px] flex flex-col">
                        <i class="ri-double-quotes-l text-3xl text-primary"></i>
                        <p class="text-sm text-gray-600 mt-4">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="right-slider flex gap-3">
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white w-[300px] flex flex-col" dir="ltr">
                        <i class="ri-double-quotes-l text-3xl text-primary text-left"></i>
                        <p class="text-sm text-gray-600 mt-4 text-start">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2 text-start">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white w-[300px] flex flex-col" dir="ltr">
                        <i class="ri-double-quotes-l text-3xl text-primary text-left"></i>
                        <p class="text-sm text-gray-600 mt-4 text-start">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2 text-start">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
