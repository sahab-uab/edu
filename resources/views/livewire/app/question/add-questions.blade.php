<div class="flex flex-col md:flex-row gap-4">
    {{-- sidebar --}}
    <div class="w-full md:w-1/2 bg-white rounded-base p-4">
        <h1 class="text-sm text-gray-400 font-semibold">নতুন প্রশ্ন যুক্ত করুন</h1>
        @php
            $question_type = [
                'mcq' => 'MCQ',
                'cq' => 'CQ',
            ];
            $subject_class = $class_id ? '' : 'pointer-events-none';
            $lession_class = $subject_id ? '' : 'pointer-events-none';
        @endphp
        <div class="flex flex-col gap-3 mt-4 border-b border-dotted border-gray-200 pb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <x-ui.select wire:model='question_type' target='question_type' label='প্রশ্নের ধরন' :dataoption="$question_type" />
                <x-ui.select wire:model.live='class_id' target='class_id' label='শ্রেনী' :dataoption="$classes" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <x-ui.select label='বিষয়' :class="$subject_class" wire:model.live='subject_id' target='subject_id'
                    :dataoption="$subjects" />
                <x-ui.select label='অধ্যায়' :class="$lession_class" wire:model='lession_id' target='lession_id'
                    :dataoption="$lession" />
            </div>
        </div>

        <div class="mt-4">
            <x-ui.input textarea='true' label='প্রশ্নর টাইটেল' hint='প্রশ্নর টাইটেল' wire:model.live='latexInput'
                target='latexInput' />
        </div>
    </div>

    <div class="w-full md:w-1/2 bg-white rounded-base p-4">
        <div>
            <div class="math-preview">{!! $latexInput !!}</div>

            <div class="math-preview">\sum_{i=1}^n i^2 = \frac{n(n+1)(2n+1)}{6}</div>
        </div>
    </div>
</div>
