<div>
    <form wire:submit.prevent="store" class="w-full flex flex-col md:flex-row gap-3">
        {{-- left side --}}
        <div class="bg-white p-4 rounded-base w-full md:w-1/2 h-fit">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h2 class="text-base font-semibold">সাধারণ তথ্য</h2>
                <p class="text-gray-600 text-sm">এই তথ্য দিয়ে একজন ইউজার তৈরি করতে পারবেন। নিচের ফর্মটি পূরণ করুন:</p>
            </div>
            <div class="flex flex-col gap-3">
                {{-- fild --}}
                <x-ui.input label='ইউজার নাম*' hint='নাম প্রদান করুন' target='name' wire:model='name' />
                <x-ui.input label='ইউজার ইমেইল*' type='email' hint='ইমেইল প্রদান করুন' target='email'
                    wire:model='email' />
                <x-ui.input label='ইউজার পাসওয়ার্ড*' hint='পাসওয়ার্ড প্রদান করুন' target='password'
                    wire:model='password' />
                @if ($userrole == 'student')
                    <x-ui.select label='ক্লাস' :dataoption="$classList" wire:model='groupclass' target='groupclass' />
                @endif
                {{-- role --}}
                <div>
                    <h2 class='text-base text-dark'>ইউজার ধরন*</h2>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                        {{-- 1 --}}
                        <label class="cursor-pointer">
                            <input wire:change="setrole('admin')" type="radio" name="option" class="hidden">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 flex flex-col items-center justify-center gap-1 {{ $userrole == 'admin' ? 'border-primary bg-primary/5' : '' }} duration-300 ">
                                <i class="ri-user-settings-line text-lg text-gray-500"></i>
                                <span class="text-gray-500 text-sm font-semibold">এডমিন</span>
                            </div>
                        </label>
                        {{--  --}}
                        <label class="cursor-pointer">
                            <input wire:change="setrole('writer')" type="radio" name="option" class="hidden">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 flex flex-col items-center justify-center gap-1 {{ $userrole == 'writer' ? 'border-primary bg-primary/5' : '' }} duration-300 ">
                                <i class="ri-user-add-line text-lg text-gray-500"></i>
                                <span class="text-gray-500 text-sm font-semibold">এডিটর</span>
                            </div>
                        </label>
                        {{-- 2 --}}
                        <label class="cursor-pointer">
                            <input wire:change="setrole('student')" type="radio" name="option" class="hidden">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 flex flex-col items-center justify-center gap-1 {{ $userrole == 'student' ? 'border-primary bg-primary/5' : '' }} duration-300 ">
                                <i class="ri-graduation-cap-line text-lg text-gray-500"></i>
                                <span class="text-gray-500 text-sm font-semibold">ছাত্র/ছাত্রী</span>
                            </div>
                        </label>
                        <!-- 3 -->
                        <label class="cursor-pointer">
                            <input wire:change="setrole('teacher')" type="radio" name="option" class="hidden">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 flex flex-col items-center justify-center gap-1 {{ $userrole == 'teacher' ? 'border-primary bg-primary/5' : '' }} duration-300 ">
                                <i class="ri-pencil-ruler-line text-lg text-gray-500"></i>
                                <span class="text-gray-500 text-sm font-semibold">শিক্ষক</span>
                            </div>
                        </label>
                    </div>
                    @error('userrole')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    @if (!empty($editId))
                        <p class="text-sm text-gray-500 mt-1.5">
                            <strong>নোটঃ </strong>
                            <span>দয়া করে মনে রাখবেন, ইউজারের ধরন (role) পরিবর্তন করলে পূর্বের সংশ্লিষ্ট সকল তথ্য মুছে
                                যাবে এবং নতুনভাবে তথ্য প্রদান করতে হবে।</span>
                        </p>
                    @endif
                </div>
            </div>
            <div class="hidden md:flex items-center mt-4 gap-3">
                <x-ui.button type='submit' target='store' text='সেভ করুন' />
                @if (!empty($editId))
                    <a href="{{ route("$refUrl") }}" wire:navigate class="text-sm text-gray-500">বাতিল
                        করুন</a>
                @else
                    <button type="button" wire:click='clearform' class="text-sm text-gray-500">ফরম ক্লিয়ার
                        করুন</button>
                @endif
            </div>
        </div>

        {{-- right side --}}
        <div class="bg-white p-4 rounded-base w-full md:w-1/2 h-fit">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h2 class="text-base font-semibold">অন্যান্য তথ্য</h2>
                <p class="text-gray-600 text-sm">এই তথ্যগুলো ঐচ্ছিক, তবে ইউজার প্রোফাইল আরও সম্পূর্ণ করতে সহায়ক হবে।
                    নিচের ফর্মটি পূরণ করুন:</p>
            </div>

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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.input label='ফোন নাম্বার' hint='ফোন নাম্বার' wire:model='phone' target='phone' />
                    <x-ui.input label='ডিপার্টমেন্ট' hint='ডিপার্টমেন্ট' wire:model='department' target='department' />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.select label='লিঙ্গ' :dataoption="$genderOptions" wire:model='gender' target='gender' />
                    <x-ui.select label='রক্তের গ্রুপ' :dataoption="$bloodGroupOptions" wire:model='blood_group'
                        target='blood_group' />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <x-ui.input label='জন্ম তারিখ' type='date' wire:model='date_of_brith'
                        target='date_of_brith' />
                    <x-ui.input label='পেশা' hint='পেশা' wire:model='petitions' target='petitions' />
                </div>
                <x-ui.input label='বায়ো' hint='তার সম্পর্কে কিছু' wire:model='bio' target='bio' />
                <x-ui.input label='ঠিকানা' hint='ঠিকানা' wire:model='address' target='address' textarea='true' />
                @if ($userrole == 'teacher')
                    <x-ui.input label='প্রতিষ্ঠানের নাম' hint='ঠিকানা' wire:model='techer_by_institute_name'
                        target='techer_by_institute_name' textarea='true' />
                @endif
            </div>
            <div class="flex md:hidden items-center mt-4 gap-3">
                <x-ui.button type='submit' target='store' text='সেভ করুন' />
                @if (!empty($editId))
                    <a href="{{ route("$refUrl") }}" wire:navigate class="text-sm text-gray-500">বাতিল
                        করুন</a>
                @else
                    <button type="button" wire:click='clearform' class="text-sm text-gray-500">ফরম ক্লিয়ার
                        করুন</button>
                @endif
            </div>
        </div>
    </form>
</div>
