<div class="bg-white p-4 rounded-base">
    {{-- header --}}
    <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
        <div class="flex items-center gap-2">
            <x-ui.button text='' iconclass='ri-sound-module-line' size='xsm' class='mt-1'
                onclick="toggleclass('#filter', ['hidden'])" />
            <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
        </div>
        <x-ui.button wire:click='modelhandler' target='modelhandler' text='নতুন ইউজার' iconclass='ri-add-line'
            iconposition='left' size='xsm' class='hidden md:flex' />
        <x-ui.button wire:click='modelhandler' class='md:hidden' target='modelhandler' text=''
            iconclass='ri-add-line' iconposition='left' size='xsm' />
    </div>
    <div class="flex items-center gap-3 mt-4 hidden flex-wrap" id="filter">
        @php
            $searchSelect = [
                'male' => 'ছাত্র',
                'female' => 'ছাত্রী',
                'other' => 'অন্যান',
            ];
        @endphp
        <x-ui.select label='লিঙ্গ' wire:model.live='gender' :dataoption="$searchSelect" size='sm' />
        @php
            $statusSelect = [
                'active' => 'সচল',
                'inactive' => 'অচল',
            ];
        @endphp
        <x-ui.select label='অবস্থা' wire:model.live='statusselect' :dataoption="$statusSelect" size='sm' />
    </div>
    <x-ui.alert />

    {{-- header end --}}
    <div class="overflow-auto">
        @if ($data && count($data) > 0)
            <table class="min-w-full mt-4 rounded-base overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">আইডি নং
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">নাম
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">ফোন
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">লিঙ্গ
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">রক্তের
                            গ্রুপ</th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">অবস্থা
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">অ্যাকশন
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach ($data as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 text-base py-3 whitespace-nowrap font-medium text-gray-800">
                                #{{ $item->id }}
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap font-medium text-gray-800">
                                <div class="flex items-center gap-3">
                                    <img src="@if ($item->profile) {{ asset('storage/' . $item->profile) }} @else {{ get_media() }} @endif"
                                        class="w-9 h-9 border border-gray-100 rounded-base">
                                    <div>
                                        <p class="text-sm">{{ $item->name }}</p>
                                        <a href='mailto:{{ $item->email }}'
                                            class="text-sm text-gray-500 underline">{{ $item->email }}</a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-gray-600 font-semibold">
                                {{ $item->phone ?? 'নেই' }}
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                @if ($item->gender == 'male')
                                    পুরুষ
                                @elseif($item->gender == 'female')
                                    মহিলা
                                @elseif($item->gender == 'other')
                                    অন্যান্য
                                @else
                                    অজানা
                                @endif
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-gray-600 font-semibold">
                                <span class="text-lg font-bold text-red-400">{{ $item->blod_group ?? 'নেই' }}</span>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                <p
                                    class="{{ $item->status == 'active' ? 'bg-secondary/10 border-secondary/20 text-secondary' : 'bg-red-50 text-red-500 border-red-200' }} border py-1 px-2 text-center rounded-base w-fit  text-sm font-semibold">
                                    @if ($item->status == 'active')
                                        সচল
                                    @else
                                        অচল
                                    @endif
                                </p>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                <div class="flex items-center">
                                    <button wire:click='edit({{ $item->id }})' class="py-1 px-2">
                                        <i class="ri-pencil-line text-blue-500"></i>
                                    </button>
                                    <button wire:confirm="আপনি কি নিশ্চিত যে আপনি এই ছাত্র/ছত্রীটিকে মুছে ফেলতে চান?"
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
            <div class="w-full flex flex-col items-center justify-center p-5 rounded-base border border-gray-100 mt-4">
                <i class="ri-emotion-sad-line text-gray-500 text-3xl"></i>
                <p class="text-base font-semibold text-gray-500 mt-2">কোন ছাত্র/ছাত্রী পাওয়া যায়নি!</p>
                <x-ui.button wire:click='modelhandler' target='modelhandler' text='নতুন ইউজার' iconclass='ri-add-line'
                    iconposition='left' size='xsm' class='mt-3' />
            </div>
        @endif
        <div class="mt-6 flex items-center justify-end">
            {{ $data->links('components.ui.pagination') }}
        </div>
    </div>

    {{-- add model --}}
    <x-ui.model model='{{ $model }}' modelTitle='ছাত্র/ছত্রী তথ্য যোগ করুন' cardSize='70%'
        controller='modelhandler'>
        <form wire:submit.prevent="studentAdd">
            <div class="w-full flex flex-col gap-4">
                <div>
                    <label for='profile'
                        class="w-[135px] cursor-pointer h-[150px] border flex items-center justify-center border-gray-200 border-dotted bg-gray-50 rounded-base">
                        @if ($profile)
                            <img src="{{ $profile->temporaryUrl() }}" class="w-full h-full object-cover rounded-base">
                        @elseif ($profileOld)
                            <img src="{{ asset('storage/' . $profileOld) }}"
                                class="w-full h-full object-cover rounded-base">
                        @else
                            <i class="ri-upload-line text-lg text-gray-500"></i>
                        @endif
                        <input type="file" id="profile" class="hidden" wire:model='profile' accept="image/*">
                    </label>
                    <small class='text-[10px] text-gray-500 text-center mt-1'>সাইজ 135px * 150px</small>
                    @error('profile')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4'>
                    <x-ui.input target='name' wire:model='name' label='ছত্র/ছত্রীর নাম*' hint='নাম' />
                    <x-ui.input target='email' wire:model='email' label='ইমেইল ঠিকানা*' hint='ইমেইল'
                        type='email' />
                    <x-ui.input target='password' wire:model='password' label='পাসওয়ার্ড*' hint='পাসওয়ার্ড'
                        type='password' />
                </div>
                <div class='grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4'>
                    @php
                        $gender = [
                            'male' => 'পুরুষ',
                            'female' => 'মহিলা',
                            'other' => 'অন্যান্য',
                        ];
                    @endphp
                    <x-ui.select target='f_gender' wire:model='f_gender' label='লিঙ্গ' :dataoption="$gender" />
                    <x-ui.input target='bloodgroup' wire:model='bloodgroup' label='রক্তের গ্রুপ'
                        hint='রক্তের গ্রুপ' />
                    <x-ui.input target='date_of_birth' wire:model='date_of_birth' label='জন্ম তারিখ'
                        hint='জন্ম তারিখ' type='date' />
                    <x-ui.input target='bio' wire:model='bio' label='জীবনবৃত্তান্ত' hint='জীবনবৃত্তান্ত' />
                </div>
                <div class='grid grid-cols-1 md:grid-cols-2 gap-4'>
                    @php
                        $data = [
                            'active' => 'সচল',
                            'inactive' => 'অচল',
                        ];
                    @endphp
                    <x-ui.input target='phone' wire:model='phone' label='ফোন নম্বর' hint='ফোন নম্বর' />
                    <x-ui.select target='status' wire:model='status' label='অবস্থা' :dataoption="$data" />
                </div>
                <x-ui.input target='address' wire:model='address' label='ঠিকানা' textarea='true' />

                <x-ui.button target='studentAdd' type='submit' text='সেভ করুন' class="justify-center w-fit" />
            </div>
        </form>
    </x-ui.model>
</div>
