<div class="mt-14 w-full md:w-[500px] mx-auto flex flex-col gap-5">
    @if ($faqQuestions)
        @foreach ($faqQuestions as $item)
            <div class="cursor-pointer">
                <div class="flex items-center justify-between" onclick="showFaq(this)">
                    <div class="flex items-center gap-x-4">
                        <i
                            class="{{ $item['icon'] }} w-8 h-8 flex items-center justify-center border border-gray-300 rounded-base text-lg text-dark"></i>
                        <h1 class="text-base text-dark font-semibold">{{ $item['question'] }}</h1>
                    </div>
                    <i class="ri-arrow-down-s-line"></i>
                </div>

                <div class="pl-12 hidden">
                    <p class="text-sm text-gray-600">{{ $item['answer'] }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
