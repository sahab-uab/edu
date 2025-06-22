<div class="bg-dark">
    <div class="safearea flex-col">
        {{-- header --}}
        <div class="py-15 border-b border-gray-100/40 border-dotted flex flex-col items-center justify-center w-full">
            <h1 class="text-3xl font-bold text-white text-center">প্রশ্ন তৈরি শুরু করুন!</h1>
            <p class="text-base font-normal mt-1 text-white text-center w-full md:w-[400px] mx-auto">এখানে আপনি নতুন
                প্রশ্ন তৈরি শুরু করতে পারবেন। প্রশ্নের শিরোনাম, বিকল্প এবং সঠিক উত্তর যুক্ত করার মাধ্যমে পরীক্ষা বা
                কোর্সের জন্য প্রস্তুতি নিন।</p>
            <x-ui.button href='ui.login' text='শুরু করুন' class='mt-4' variant='secondary' iconclass='ri-arrow-right-line' />
        </div>
        {{-- header end --}}

        {{--  --}}
        <div class="grid grid-cols-1 md:grid-col-3 lg:grid-cols-5 pt-15 gap-10">
            <div class="col-span-2">
                <x-ui.logo class="h-[30px] w-auto" />
                <p class="text-white mt-4 text-base">একটি নিরাপদ ও সহজ পেপারলেস অনলাইন পরীক্ষা প্ল্যাটফর্ম, শিক্ষার্থী ও
                    শিক্ষকদের জন্য দ্রুত ও সুশৃঙ্খল পরীক্ষার সুযোগ প্রদান করে।</p>

                <x-parts.social-link/>
            </div>

            <div class="flex flex-col gap-4">
                <ul>
                    <li class="text-white font-bold text-base">সর্বজনীন</li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">হোম</a>
                    </li>
                    <li><a href=""
                            class="text-white text-sm duration-300 hover:text-primary hover:pl-3">লিঙ্ক</a></li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">আমাদের
                            নিয়ে</a></li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">লিংক
                            ১</a></li>
                </ul>
                <ul>
                    <li class="text-white font-bold text-base">উপকরণ</li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">হোম</a>
                    </li>
                    <li><a href=""
                            class="text-white text-sm duration-300 hover:text-primary hover:pl-3">লিঙ্ক</a></li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">আমাদের
                            নিয়ে</a></li>
                    <li><a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">লিংক
                            ১</a></li>
                </ul>
            </div>

            <div class="flex flex-col gap-4">
                <ul>
                    <li class="text-white font-bold text-base">আরো লিংক</li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col gap-4">
                <ul>
                    <li class="text-white font-bold text-base">অফার🎉</li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-white text-sm duration-300 hover:text-primary hover:pl-3">
                        লিংক১
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-dotted border-gray-100/50 w-full py-5 mt-15">
            <p class="text-white text-sm text-center">© {{ now()->format('Y') }} {{ config('app.name') }}. All rights reserved</p>
        </div>
    </div>
</div>
