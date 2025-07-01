<div>
    <div class="bg-white p-4 rounded-base w-full md:w-1/2">
        <div class="flex justify-between gap-3 border-b border-gray-200 pb-3 mb-3">
            <h1 class="text-base text-dark font-semibold">গুগোল লগিন</h1>
            <div class="flex items-center justify-center border border-gray-200 rounded-base w-fit">
                <button wire:click="changestatus('active')" {{ $status == 'active' ? 'disabled' : '' }}
                    class="text-[10px] px-2 h-6  {{ $status == 'active' ? ' cursor-not-allowed bg-green-200' : 'bg-gray-200' }}">চালু</button>

                <button wire:click="changestatus('inactive')" {{ $status == 'inactive' ? 'disabled' : '' }}
                    class="text-[10px] px-2 h-6 border-l border-white {{ $status == 'inactive' ? 'cursor-not-allowed bg-red-200' : ' bg-gray-200' }}">বন্ধ</button>
            </div>
        </div>
        <x-ui.alert />
        <form wire:submit.prevent="update" class="w-full">
            <div class="flex flex-col gap-3">
                <x-ui.input label='ক্লাইন্ট আইডি*' hint='GOOGLE_CLIENT_ID' wire:model='clint_id' target='clint_id' />
                <x-ui.input label='ক্লায়েন্ট সিক্রেট*' hint='GOOGLE_CLIENT_SECRET' wire:model='clint_secrate'
                    target='clint_secrate' />
                <x-ui.input label='রিডাইরেক্ট URL*' hint='GOOGLE_REDIRECT_URL' type='url' wire:model='redirect_url'
                    target='redirect_url' />
                <x-ui.button type='submit' text='সেভ করুন' target='update' class="justify-center" />
            </div>
        </form>
    </div>
</div>
