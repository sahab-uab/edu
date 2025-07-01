<div class="w-full">
    {{-- banner --}}
    <section class="w-full bg-cover bg-no-repeat bg-center py-32"
        style="background-image: url('{{ get_media('banner.png') }}')">
        <div class="safearea flex-col justify-center">
            <h1 class="text-[40px] md:text-banner text-white font-black w-full md:w-[70%] text-center mx-auto">দেশের
                একমাত্র
                <span class="text-primary">পেপারলেস</span> স্মার্ট প্রশ্নব্যাংক!
            </h1>
            <p data-aos-delay="500" class="text-white text-base font-light text-center">সকল পরীক্ষার প্রশ্নব্যাংক,
                টেস্টপেপার, আনলিমিটেড পরীক্ষা, প্রশ্ন ও
                অনলাইন পরীক্ষা তৈরী!</p>

            <div class="mt-10 flex items-center gap-x-2">
                <x-ui.button text='ফ্রি-তে প্রশ্নব্যাংক দেখুন' variant='secondary' iconclass='ri-arrow-right-line'
                    data-aos-delay="600" />
                <x-ui.button wire:click='videoModelControll' text='' variant='secondary'
                    iconclass='ri-play-mini-line' data-aos-delay="700" />
            </div>
        </div>
    </section>
    {{-- banner end --}}

    {{-- choicers --}}
    <section class='py-15'>
        <div class="safearea flex-col justify-center">
            <div>
                <h1 class="text-3xl font-bold text-dark text-center">{{ config('app.name') }} কেন বেছে নেবেন?</h1>
                <p class="text-base text-center font-medium text-gray-500 w-full md:w-[500px] mt-2">সহজ, নিরাপদ ও
                    নির্ভরযোগ্য — তোমার পেপারলেস পরীক্ষার ওয়েবসাইটকে সামনে নিতে {{ config('app.name') }}-ই
                    সেরা সমাধান</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mt-10 w-full md:w-[70%] lg:w-[800px]">
                <div class="border border-gray-100 rounded-base p-5 duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <i
                        class="ri-medal-line w-12 h-12 rounded-base flex items-center justify-center text-2xl bg-gray-100 text-primary mb-4"></i>
                    <h1 class="text-base font-bold text-dark">সনদপত্র গ্রহণ করুন</h1>
                    <p class="text-gray-600 text-sm mt-1">পরীক্ষা সম্পন্ন করার সাথে সাথে অনলাইনেই পেয়ে যাও তোমার অর্জিত
                        সনদপত্র — সহজ, ঝামেলাহীন ও সম্পূর্ণ পেপারলেস!</p>
                </div>
                <div class="border border-gray-100 rounded-base p-5 duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <i
                        class="ri-user-follow-line w-12 h-12 rounded-base flex items-center justify-center text-2xl bg-gray-100 text-secondary mb-4"></i>
                    <h1 class="text-base font-bold text-dark">সদস্যপদ গ্রহণ করুন</h1>
                    <p class="text-gray-600 text-sm mt-1">সদস্য হয়ে বিশেষ সুবিধা উপভোগ করুন — সহজে পরীক্ষায় অংশগ্রহণ,
                        সাথে সাথে সনদপত্র গ্রহণ ও আরও অনেক কিছু!</p>
                </div>
                <div class="border border-gray-100 rounded-base p-5 duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <i
                        class="ri-shield-user-fill w-12 h-12 rounded-base flex items-center justify-center text-2xl bg-gray-100 text-primary mb-4"></i>
                    <h1 class="text-base font-bold text-dark">শিক্ষক হোন</h1>
                    <p class="text-gray-600 text-sm mt-1">আপনার জ্ঞান দিয়ে নতুন প্রজন্মকে গড়ে তুলুন — সহজ পদ্ধতিতে
                        শিক্ষক হিসেবে যোগদান করে শুরু করুন।</p>
                </div>
            </div>
        </div>
    </section>
    {{-- choicers end --}}

    {{-- statics --}}
    <section class="py-15 border-t border-b border-gray-100 bg-gray-50/80">
        <div class="safearea">
            <div class="w-full mx-auto md:w-[70%] lg:w-[800px]">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mg:gap-10">
                    <div
                        class="flex items-center gap-x-4 bg-white p-4 rounded-base duration-300 hover:scale-[1.02] hover:shadow-lg border border-gray-100">
                        <i
                            class="ri-question-fill min-w-10 min-h-10 bg-secondary/10 rounded-full flex items-center justify-center text-secondary"></i>
                        <p class="text-sm text-gray-500 font-semibold">
                            সেরা অনলাইন প্রশ্ন থেকে {{ formatToBangla(10000) }} টি।
                        </p>
                    </div>
                    <div
                        class="flex items-center gap-x-4 bg-white p-4 rounded-base duration-300 hover:scale-[1.02] hover:shadow-lg border border-gray-100">
                        <i
                            class="ri-user-smile-fill min-w-10 min-h-10 bg-secondary/10 rounded-full flex items-center justify-center text-primary"></i>
                        <p class="text-sm text-gray-500 font-semibold">
                            {{ formatToBangla(10000) }} এরও বেশি অভিজ্ঞ ও বিশেষজ্ঞ পরামর্শদাতা।
                        </p>
                    </div>
                    <div
                        class="flex items-center gap-x-4 bg-white p-4 rounded-base duration-300 hover:scale-[1.02] hover:shadow-lg border border-gray-100">
                        <i
                            class="ri-chat-smile-2-fill min-w-10 min-h-10 bg-secondary/10 rounded-full flex items-center justify-center text-secondary"></i>
                        <p class="text-sm text-gray-500 font-semibold">
                            {{ formatToBangla(1000000) }}+ শিক্ষার্থীর রেটিং ও রিভিউ এর সাথে {{config('app.name')}}।
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- statics end --}}

    {{-- question maker demo --}}
    <section class="py-15 w-full border-b border-dotted border-gray-200">
        <div class="safearea flex-col">
            <div>
                <h1 class="text-3xl font-bold text-dark text-center">১ ক্লিকে প্রশ্ন তৈরী!</h1>
                <p class="text-base text-center font-medium text-gray-500 w-full md:w-[500px] mt-2">শুধু প্রশ্ন সিলেক্ট
                    করুন, প্রশ্নপত্র তৈরী হবে অটোমেটিক !</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-14 w-full">
                <div class="bg-white rounded-base border border-gray-200 p-5">
                    <div>
                        <h1 class="text-dark font-bold">প্রশ্ন সিলেক্ট করুন</h1>
                        <p class="text-sm text-gray-600">প্রশ্নগুলো সিলেক্ট করে সাবমিট করলেই প্রশ্ন তৈরী হয়ে যাবে !</p>
                    </div>
                    <div class="mt-4 flex flex-col gap-2">
                        @foreach ($demoquestions as $index => $item)
                            @php
                                // Check if this demo question is in paperquestion by comparing 'index'
                                $isAdded = collect($paperquestion)->contains('index', $index);
                            @endphp

                            <div wire:click="addquestion({{ $index }})"
                                class="border border-gray-200 p-4 rounded-base duration-300
                                    {{ $isAdded ? 'border-l-3 border-r-3 border-l-secondary border-r-secondary' : '' }}
                                    hover:scale-[1.02] hover:shadow-lg hover:border-l-3 hover:border-r-3 hover:border-l-secondary hover:border-r-secondary">
                                <p class="text-base text-dark">
                                    <span>{{ formatToBangla($index + 1) }}.</span>
                                    <span>{{ $item['title'] }}</span>
                                </p>
                                <div class="grid grid-cols-2 gap-2 mt-2 pl-4">
                                    @foreach ($item['question'] as $option)
                                        <p class="text-base text-dark">{{ $option }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-100 rounded-base p-2">
                    <div class="bg-white w-full h-full p-4 rounded-base">
                        {{-- question header --}}
                        <header class="text-center">
                            <h1 class="text-lg font-bold text-dark">স্বাধীন বাংলা একাডেমি</h1>
                            <h2 class="text-base text-dark">শ্রেনীঃ ৭ম</h2>
                            <h2 class="text-base text-dark">বিষয়ঃ সাধারন জ্ঞান</h2>
                        </header>
                        <div class="flex items-center justify-between text-sm border-b border-gray-200 pb-2 mt-3">
                            <p>সময়ঃ {{ formatToBangla($totalQuestion) }}মিনিট</p>
                            <p>পূর্ণমানঃ {{ formatToBangla($totalQuestion) }}</p>
                        </div>

                        {{-- question --}}
                        <div class="mt-4 flex flex-col gap-2">
                            @foreach ($paperquestion as $index => $item)
                                <div class="relative group">
                                    <x-ui.button text='' target='removequestion'
                                        wire:click="removequestion({{ $item['index'] }})"
                                        class="bg-red-50 text-red-500 border-red-100 absolute right-0 top-0 duration-300 group-hover:opacity-100 opacity-0"
                                        variant='action' size='xsm' iconclass='ri-delete-bin-line' />
                                    <p class="text-base text-dark">
                                        <span>{{ formatToBangla($index + 1) }}.</span>
                                        <span>{{ $item['title'] }}</span>
                                    </p>
                                    <div class="grid grid-cols-2 gap-2 mt-2 pl-4">
                                        @foreach ($item['question'] as $option)
                                            <p class="text-base text-dark">{{ $option }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-15 w-full md:w-[450px]">
                <p class="text-lg text-dark text-center">
                    সারাদেশে {{ formatToBangla(100000) }}+ শিক্ষা প্রতিষ্ঠান এখন স্মার্ট ওয়েতে প্রশ্ন তৈরী করছে! আপনি
                    কেন পিছিয়ে থাকবেন?
                </p>
            </div>
        </div>
    </section>
    {{-- question maker demo end --}}

    {{-- revies --}}
    <section class="py-15 w-full bg-gray-50/80">
        <div class="safearea flex-col overflow-hidden">
            <div>
                <h1 class="text-3xl font-bold text-dark text-center">দেখে নিন কি বলছেন!</h1>
                <p class="text-base text-center font-medium text-gray-500 w-full md:w-[500px] mt-2">শিক্ষক, শিক্ষার্থী ও
                    অভিভাবক সবাই আস্থা রেখেছে এখানে — পেছনে নেই অভিভাবকরাও!</p>
            </div>

            {{-- slider --}}
            <x-parts.ui.reviews />
        </div>
    </section>
    {{-- revies end --}}

    {{-- faqs --}}
    <section class="py-15 w-full">
        <div class="safearea flex-col">
            <div>
                <h1 class="text-3xl font-bold text-dark text-center">প্রায়শই জিজ্ঞাসিত প্রশ্নাবলী (FAQ)</h1>
                <p class="text-base text-center font-medium text-gray-500 w-full md:w-[500px] mt-2">জানুন আমাদের সাধারণ
                    প্রশ্ন ও তাদের সঠিক উত্তর, যাতে আপনার যেকোনো সংশয় দূর হয় দ্রুত।</p>
            </div>
            <x-parts.ui.faqs />
        </div>
    </section>
    {{-- faqs end --}}

    {{-- all model --}}
    <x-ui.model model='{{ $videoModel }}' bodyClose='true' cardSize='800px' controller='videoModelControll'
        headerfalse='true' bodyClass='p-0'>
        <iframe id="youtube-player" class="w-full aspect-video"
            src="https://www.youtube-nocookie.com/embed/SuoBI_6qmT0?si=5aM0VbUzIRRrwfdt&enablejsapi=1"
            title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
    </x-ui.model>
</div>
