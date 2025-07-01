<div class="bg-white p-4 rounded-base">
    <form wire:submit.prevtn="update">
        <x-ui.alert />
        {{-- image --}}
        <div class="mb-4 flex flex-col items-center md:items-start">
            @php
                $newImage = get_media();
                if (isset($image) && method_exists($image, 'temporaryUrl')) {
                    $newImage = $image->temporaryUrl();
                } elseif (!empty($oldImage)) {
                    $newImage = asset('storage/' . $oldImage);
                }
            @endphp
            <div class="flex flex-col items-center">
                <img src="{{ $newImage }}"
                    class="w-[100px] h-[100px] object-contain rounded-full bg-gray-50 border border-gray-200">
                <input type="file" id="user-image-input" class="hidden" accept="image/*" wire:model='image'>
                <x-ui.button target='image' text='ছবি পরিবর্তন করুন' size='xsm' variant='action-primary'
                    class='rounded-full px-4 mt-1 text-[10px]'
                    onclick="document.getElementById('user-image-input').click();" />
            </div>
        </div>
        <div class="mt-3 flex flex-col gap-3">
            @if (Auth::user()->role == 'student')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.select label='ক্লাস' :dataoption="$classList" wire:model='groupclass' target='groupclass' />
                    <x-ui.input label='ডিপার্টমেন্ট' hint='ডিপার্টমেন্ট' wire:model='department' target='department' />
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <x-ui.input label='নাম' wire:model='name' target='name' />
                <x-ui.input label='ইমেইল' :value="Auth::user()->email" readonly/>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <x-ui.input label='ফোন নাম্বার' hint='ফোন নাম্বার' wire:model='phone' target='phone' />
                <x-ui.select label='লিঙ্গ' :dataoption="$genderOptions" wire:model='gender' target='gender' />
                <x-ui.select label='রক্তের গ্রুপ' :dataoption="$bloodGroupOptions" wire:model='blood_group' target='blood_group' />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <x-ui.input label='জন্ম তারিখ' type='date' wire:model='date_of_brith' target='date_of_brith' />
                <x-ui.input label='পেশা' hint='পেশা' wire:model='petitions' target='petitions' />
            </div>
            <x-ui.input label='বায়ো' hint='তার সম্পর্কে কিছু' wire:model='bio' target='bio' />
            <x-ui.input label='ঠিকানা' hint='ঠিকানা' wire:model='address' target='address' textarea='true' />
            @if (Auth::user()->role == 'teacher')
                <x-ui.input label='প্রতিষ্ঠানের নাম' hint='ঠিকানা' wire:model='techer_by_institute_name'
                    target='techer_by_institute_name' textarea='true' />
            @endif
        </div>
        <x-ui.button type='submit' text='সেভ করুন' target='update' class='mt-4' />
    </form>
</div>
