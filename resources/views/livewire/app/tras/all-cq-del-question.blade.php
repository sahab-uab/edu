<div>
    <div class="bg-white p-4 rounded-base mt-5">
        {{-- header --}}
        <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
            <div class="flex items-center gap-2">
                <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
            </div>
        </div>
        <x-ui.alert />

        {{-- header end --}}
        <div class="overflow-auto">
            @if ($data && count($data) > 0)
                <table class="min-w-full mt-4 rounded-base overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                বিবরণ
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                প্রশ্ন
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                তৈরী করেছেন
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                সর্বশেষ পরিবর্তন
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                অ্যাকশন
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @foreach ($data as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td
                                    class="px-4 text-base py-3 whitespace-nowrap font-medium text-gray-800 max-w-[200px]">
                                    <p class="flex items-center gap-1 flex-wrap text-sm">
                                        <i class="ri-arrow-right-double-line"></i>
                                        {{ $item->groupeClass->name }}
                                        <i class="ri-arrow-right-line text-sm text-gray-500"></i>
                                        {{ $item->subject->name }}
                                        <i class="ri-arrow-right-line text-sm text-gray-500"></i>
                                        {{ $item->lession->name }}
                                        <i class="ri-arrow-right-line text-sm text-gray-500"></i>
                                        {{ $item->type->name }}
                                    </p>
                                </td>
                                <td class="px-4 text-base py-3 text-gray-600 font-semibold max-w-[200px]">
                                    <p class='math-container text-sm'>
                                        {!! $item->questiontitle !!}
                                    </p>
                                </td>
                                <td class="px-4 text-base py-3 whitespace-nowrap">
                                    <p class="text-sm flex items-center gap-1">
                                        @if (Auth::id() == $item->created_who->id)
                                            <span class="font-semibold">আপনার তৈরি</span>
                                        @else
                                            <span>{{ $item->created_who->name ?? 'অজানা' }}</span>
                                        @endif
                                    </p>
                                    <small>{{ date_to_bangla($item->created_at) }}</small>
                                </td>
                                <td class="px-4 text-base py-3 whitespace-nowrap">
                                    <p class="text-sm">{{ $item->updated_who->name ?? 'অজানা' }}</p>
                                    @if (!empty($item->updated_who->name))
                                        <small class='text-gray-500'>{{ date_to_bangla($item->updated_at) }}</small>
                                    @endif
                                </td>
                                <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                    <div class="flex items-center">
                                        <button wire:click='view({{ $item->id }})' class="py-1 px-2">
                                            <i class="ri-eye-line text-blue-500"></i>
                                        </button>
                                        <button wire:confirm="আপনি কি নিশ্চিত যে আপনি এই CQ টি ফিরিয়ে আনতে চান?"
                                            wire:click='restore({{ $item->id }})' class="py-1 px-2">
                                            <i class="ri-refresh-line text-blue-500"></i>
                                        </button>
                                        <button wire:confirm="আপনি কি নিশ্চিত যে আপনি এই CQ টি মুছে ফেলতে চান? এখান থেকে মুছে ফেলা হলে আর ফিরিয়ে আনা যাবে না!"
                                            wire:click='delete({{ $item->id }})' class="py-1 px-2">
                                            <i class="ri-delete-bin-line text-red-500"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div
                    class="w-full flex flex-col items-center justify-center p-5 rounded-base border border-gray-100 mt-4">
                    <i class="ri-emotion-sad-line text-gray-500 text-3xl"></i>
                    <p class="text-base font-semibold text-gray-500 mt-2">কোন প্রশ্ন পাওয়া যায়নি!</p>
                </div>
            @endif
            <div class="mt-6 flex items-center justify-end">
                {{ $data->links('components.ui.pagination') }}
            </div>
        </div>
    </div>

    {{-- add model --}}
    <x-ui.model model='{{ $model }}' modelTitle='প্রশ্নর প্রিভিউ' cardSize='600px'
        controller='modelHandler'>
        @if ($viewData)
            <div class="p-4">
            @empty(!$viewData->image)
                <div class="flex items-center mb-4 justify-{{ $viewData->image_align }}">
                    <img src="{{ asset('storage/' . $viewData->image) }}" alt="Image Preview"
                        class="mt-2 h-32 rounded-base" />
                </div>
            @endempty
            <h2 class="text-base font-semibold math-container">{{ $viewData->questiontitle ?? '' }}</h2>
            <div class="mt-4 flex flex-col gap-4">
                <div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600">
                        <span class="text-dark math-container">প্রশ্নঃ </span>
                        <span class='math-container'>{{ $viewData->q_1 }}</span>
                    </div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600 mt-1">
                        <span class="text-dark math-container">উত্তরঃ </span>
                        <span class='math-container'>{{ $viewData->q_1_ans ?? 'নেই' }}</span>
                    </div>
                </div>
                {{-- 2 --}}
                <div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600">
                        <span class="text-dark math-container">প্রশ্নঃ </span>
                        <span class='math-container'>{{ $viewData->q_2 }}</span>
                    </div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600 mt-1">
                        <span class="text-dark math-container">উত্তরঃ </span>
                        <span class='math-container'>{{ $viewData->q_2_ans ?? 'নেই' }}</span>
                    </div>
                </div>
                {{-- 3 --}}
                <div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600">
                        <span class="text-dark math-container">প্রশ্নঃ </span>
                        <span class='math-container'>{{ $viewData->q_3 }}</span>
                    </div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600 mt-1">
                        <span class="text-dark math-container">উত্তরঃ </span>
                        <span class='math-container'>{{ $viewData->q_3_ans ?? 'নেই' }}</span>
                    </div>
                </div>
                {{-- 4 --}}
                <div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600">
                        <span class="text-dark math-container">প্রশ্নঃ </span>
                        <span class='math-container'>{{ $viewData->q_4 }}</span>
                    </div>
                    <div class="flex items-start gap-x-2 text-sm text-gray-600 mt-1">
                        <span class="text-dark math-container">উত্তরঃ </span>
                        <span class='math-container'>{{ $viewData->q_4_ans ?? 'নেই' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 hidden" id="video-preview">
            @if ($viewData->videoLink)
                <iframe width="560" height="315" src="{{ $viewData->videoLink }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            @endif
        </div>
        <div class="mt-3 flex items-center justify-end gap-2 p-4 border-t border-gray-200">
            @if ($viewData->videoLink)
                <x-ui.button onclick="toggleclass('#video-preview', ['hidden'])" text=''
                    iconclass='ri-play-circle-line' size='sm' />
            @endif
        </div>
    @endif
</x-ui.model>
{{-- add model end --}}
</div>
