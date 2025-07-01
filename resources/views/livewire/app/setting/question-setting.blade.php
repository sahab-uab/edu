<div class="">
    <x-ui.alert/>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded-base w-full flex flex-col gap-4">
            <div class="border-b border-gray-200 pb-3">
                <h1 class="text-base font-semibold text-gray-800">MCQ প্রশ্নের দাম</h1>
                <p class="text-gray-600 text-sm">এখানে নির্ধারিত মূল্য প্রতি MCQ প্রশ্নের জন্য প্রযোজ্য হবে। আপনি চাইলে
                    পরে
                    এটি পরিবর্তন করতে পারবেন।</p>
            </div>
            <form wire:submit.prevtn="mcqUpdate" class="flex flex-col gap-4">
                <x-ui.input step='0.01' type='number' label='দাম*' wire:model='mcq_price' target='mcq_price' />
                <x-ui.button text='সেভ করুন' type='submit' target='mcqUpdate' class="w-fit" />
            </form>
        </div>
        <div class="bg-white p-4 rounded-base w-full flex flex-col gap-4">
            <div class="border-b border-gray-200 pb-3">
                <h1 class="text-base font-semibold text-gray-800">CQ প্রশ্নের দাম</h1>
                <p class="text-gray-600 text-sm">এখানে নির্ধারিত মূল্য প্রতি CQ প্রশ্নের জন্য প্রযোজ্য হবে। আপনি চাইলে
                    পরে
                    এটি পরিবর্তন করতে পারবেন।</p>
            </div>
            <form wire:submit.prevtn="cqUpdate" class="flex flex-col gap-4">
                <x-ui.input step='0.01' type='number' label='দাম*' wire:model='cq_price' target='cq_price' />
                <x-ui.button text='সেভ করুন' type='submit' target='cqUpdate' class="w-fit" />
            </form>
        </div>
        <div class="bg-white p-4 rounded-base w-full flex flex-col gap-4">
            <div class="border-b border-gray-200 pb-3">
                <h1 class="text-base font-semibold text-gray-800">SQ প্রশ্নের দাম</h1>
                <p class="text-gray-600 text-sm">এখানে নির্ধারিত মূল্য প্রতি SQ প্রশ্নের জন্য প্রযোজ্য হবে। আপনি চাইলে
                    পরে
                    এটি পরিবর্তন করতে পারবেন।</p>
            </div>
            <form wire:submit.prevtn="sqUpdate" class="flex flex-col gap-4">
                <x-ui.input step='0.01' type='number' label='দাম*' wire:model='sq_price' target='sq_price' />
                <x-ui.button text='সেভ করুন' type='submit' target='sqUpdate' class="w-fit" />
            </form>
        </div>
    </div>
</div>
