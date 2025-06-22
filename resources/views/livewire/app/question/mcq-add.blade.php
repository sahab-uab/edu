<div class="flex flex-col md:flex-row gap-4">
    {{-- sidebar --}}
    <div class="w-full md:w-1/2 bg-white rounded-base p-4">
        <h1 class="text-sm text-gray-400 font-semibold">নতুন MCQ প্রশ্ন যুক্ত করুন</h1>
        @php
            $question_lavel = [
                'genarel' => 'সাধারণ MCQ',
                'difficult' => 'উচ্চতর দক্ষতা MCQ',
            ];
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
                <x-ui.select label='প্রশ্ননের জটিলতা*' wire:model='question_lavel' target='question_lavel'
                    :dataoption="$question_lavel" />
            </div>
            <x-ui.select label='প্রশনের ধরন*' :class="$lession_class" wire:model='question_type_id' target='question_type_id'
                :dataoption="$question_type" />
        </div>

        <div class="mt-4 flex flex-col gap-3">
            <x-ui.input label='ভিডিও লিঙ্ক' hint='ভিডিও লিঙ্ক' wire:model='videoLink' target='videoLink' />
            <x-ui.input label='ছবি যুক্ত করুন' id='image' accept='image/*' type='file' wire:model='image'
                target='image' />
            <x-ui.input textarea='true' label='প্রশ্নর টাইটেল*' hint='প্রশ্নর টাইটেল' wire:model.live='questiontitle'
                target='latexInput' />

            {{-- question --}}
            <div class="gap-4 flex items-center">
                <x-ui.input label='ভিডিও লিঙ্ক' hint='ভিডিও লিঙ্ক' wire:model='videoLink' target='videoLink' />
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/2 bg-white rounded-base p-8 h-fit sticky top-0">
        <span class="text-sm font-semibold text-primary bg-primary/10 rounded-base py-1 px-2">MCQ প্রিভিউ</span>
        <div class="flex flex-col mt-4">
            <span class="font-bold text-gray-500">প্রশ্ন:</span>
            <div class="math-preview mt-1">{!! $questiontitle ? $questiontitle : 'প্রশ্ন লিখুন!' !!}</div>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div class="flex flex-col mt-4">
                <span class="font-semibold text-gray-500">ক.</span>
                <div class="math-preview mt-1">{!! $questiontitle ? $questiontitle : 'ধারনা..!' !!}</div>
            </div>
            <div class="flex flex-col mt-4">
                <span class="font-semibold text-gray-500">খ.</span>
                <div class="math-preview mt-1">{!! $questiontitle ? $questiontitle : 'ধারনা..!' !!}</div>
            </div>
            <div class="flex flex-col mt-4">
                <span class="font-semibold text-gray-500">গ.</span>
                <div class="math-preview mt-1">{!! $questiontitle ? $questiontitle : 'ধারনা..!' !!}</div>
            </div>
            <div class="flex flex-col mt-4">
                <span class="font-semibold text-gray-500">ঘ.</span>
                <div class="math-preview mt-1">{!! $questiontitle ? $questiontitle : 'ধারনা..!' !!}</div>
            </div>
        </div>
    </div>
</div>
