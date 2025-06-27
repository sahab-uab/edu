<div class="flex flex-col md:flex-row gap-4">
    {{-- sidebar --}}
    <div class="w-full md:w-1/2 bg-white rounded-base p-4">
        <form wire:submit.prevent="store" class="w-full">
            <h1 class="text-sm text-gray-400 font-semibold">নতুন CQ প্রশ্ন যুক্ত করুন</h1>
            @php
                $subject_class = $class_id ? '' : 'pointer-events-none';
                $lession_class = $subject_id ? '' : 'pointer-events-none';
            @endphp
            <div class="flex flex-col gap-3 mt-4 border-b border-dotted border-gray-200 pb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.select wire:model.live='class_id' target='class_id' label='শ্রেনী*' :dataoption="$classes" />
                    <x-ui.select label='বিষয়*' :class="$subject_class" wire:model.live='subject_id' target='subject_id'
                        :dataoption="$subjects" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.select label='অধ্যায়*' :class="$lession_class" wire:model='lession_id' target='lession_id'
                        :dataoption="$lession" />
                    <x-ui.select label='প্রশনের ধরন*' :class="$lession_class" wire:model='question_type_id'
                        target='question_type_id' :dataoption="$question_type" />
                </div>
            </div>

            <div class="mt-4 flex flex-col gap-3">
                <x-ui.input label='ভিডিও লিঙ্ক [Youtube Embedding Url]' target='videoLink' hint='ভিডিও লিঙ্ক'
                    wire:model='videoLink' target='videoLink' />
                <div class="relative">
                    <div class="absolute top-0 right-0 flex items-center gap-x-2">
                        <i class="ri-loader-2-line animate-spin" wire:loading wire:target='image'></i>
                        <button type="button" wire:click="setImageAlign('left')"
                            class="text-base w-5 h-5 {{ $image_align === 'left' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600' }} duration-300 hover:text-dark"
                            title='Align Left'><i class="ri-align-left"></i></button>
                        <button type="button" wire:click="setImageAlign('center')"
                            class="text-base w-5 h-5 {{ $image_align === 'center' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600' }} duration-300 hover:text-dark"
                            title='Align Center'><i class="ri-align-center"></i></button>
                        <button type="button" wire:click="setImageAlign('end')"
                            class="text-base w-5 h-5 {{ $image_align === 'end' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600' }} duration-300 hover:text-dark"
                            title='Align Right'><i class="ri-align-right"></i></button>
                    </div>
                    <x-ui.input label='ছবি যুক্ত করুন' target='image' id='image' accept='image/*' type='file'
                        wire:model='image' target='image' />
                </div>
                <x-ui.input textarea='true' target='questiontitle' label='উদ্দীপক *' hint='উদ্দীপক'
                    wire:model.live='questiontitle' />

                {{-- প্রশ্ন ১ --}}
                <x-ui.input target='q_1' label='প্রশ*' hint='প্রশ্ন' wire:model.live='q_1' />
                <x-ui.input textarea='true' target='q_1_ans' label='প্রশ্নের উত্তর' hint='প্রশ্নের উত্তর'
                    wire:model.live='q_1_ans' />
            </div>
            {{-- submit button --}}
            <div class="mt-6 flex items-center justify-end gap-3">
                <x-ui.button text='সেভ করুন' target='store' type='submit' />

                @if ($editId)
                    <a href='{{ route('ux.allquestions.sq') }}' wire:navigate
                        class="text-sm text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line"></i>
                        বাতিল করুন
                    </a>
                @else
                    <button type="button" class="text-sm text-gray-500 hover:text-gray-700" wire:click='resetForm'>
                        <i class="ri-close-line"></i>
                        বাতিল করুন
                    </button>
                @endif
            </div>
        </form>
    </div>

    <div class="w-full md:w-1/2 bg-white rounded-base p-4 h-fit sticky top-0">
        <span class="text-sm font-semibold text-primary bg-primary/10 rounded-base py-1 px-2">CQ প্রিভিউ</span>
        @if ($image)
            <div class="mt-4 flex items-center justify-{{ $image_align }}">
                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="mt-2 max-h-48 rounded-base" />
            </div>
        @endif
        @if ($oldImage)
            <div class="mt-4 flex items-center justify-{{ $image_align }}">
                <img src="{{ asset('storage/' . $oldImage) }}" alt="Image Preview" class="mt-2 max-h-48 rounded-base" />
            </div>
        @endif
        <div class="flex flex-col mt-4">
            <span class="font-bold text-dark">উদ্দীপক:</span>
            <div class="math-container mt-1 text-gray-500">{!! $questiontitle ? $questiontitle : 'প্রশ্ন লিখুন!' !!}</div>
        </div>
        <div class="mt-5">
            <div class="flex items-center gap-x-2">
                <span class="font-bold text-dark">প্রশ্ন:</span>
                <div class="math-container mt-1 text-base text-gray-500">{!! $q_1 !!}</div>
            </div>
            <span class="font-bold text-dark">উত্তর:</span>
            <div class="math-container mt-1 text-base text-gray-500">{!! $q_1_ans !!}</div>
        </div>
    </div>
</div>
