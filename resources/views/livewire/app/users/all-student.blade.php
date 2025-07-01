<div class="bg-white p-4 rounded-base">
    {{-- header --}}
    <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
        <div class="flex items-center gap-2">
            <x-ui.button text='' iconclass='ri-sound-module-line' size='xsm' class='mt-1'
                onclick="toggleclass('#filter', ['hidden'])" />
            <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
        </div>
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
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                            ব্যালেন্স</th>
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
                                {{ formatToBangla($item->amount) }} টাকা
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center border border-gray-200 rounded-base w-fit">
                                    <button wire:click="changestatus({{ $item->id }}, 'active')"
                                        {{ $item->status == 'active' ? 'disabled' : '' }}
                                        class="text-[10px] px-2 h-6  {{ $item->status == 'active' ? ' cursor-not-allowed bg-green-200' : 'bg-gray-200' }}">চালু</button>

                                    <button wire:click="changestatus({{ $item->id }}, 'inactive')"
                                        {{ $item->status == 'inactive' ? 'disabled' : '' }}
                                        class="text-[10px] px-2 h-6 border-l border-white {{ $item->status == 'inactive' ? 'cursor-not-allowed bg-red-200' : ' bg-gray-200' }}">বন্ধ</button>
                                </div>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                <div class="flex items-center">
                                    <button wire:click='view({{ $item->id }})' class="py-1 px-2">
                                        <i class="ri-eye-line text-blue-500"></i>
                                    </button>
                                    <a href="{{ route('ux.add.users', ['id' => $item->id, 'ref' => 'ux.allstudent']) }}"
                                        class="py-1 px-2">
                                        <i class="ri-pencil-line text-blue-500"></i>
                                    </a>
                                    <button wire:click="moneyAddModel({{ $item->id }})" class="py-1 px-2">
                                        <i class="ri-money-dollar-circle-line text-blue-500"></i>
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
            </div>
        @endif
        <div class="mt-6 flex items-center justify-end">
            {{ $data->links('components.ui.pagination') }}
        </div>
    </div>

    {{-- add model --}}
    <x-ui.model model='{{ $model }}' modelTitle='ছাত্র/ছত্রী তথ্য' cardSize='400px' controller='modelhandler'>
        @if ($viewData)
            <div class="flex flex-col items-center">
                <img class="w-[100px] h-[100px] rounded-full overflow-hidden flex items-center justify-center border-2 border-gray-200 object-cover"
                    src="{{ $viewData->profile ? asset('storage/' . $viewData->profile) : get_media() }}">
                <p class="text-sm text-gray-500 mt-2">{{ $viewData->bio ?? '' }}</p>
                <p class="text-base text-gray-500 mt-1">ছাত্র/ছাত্রী</p>
            </div>
            <div class="mt-3 flex flex-col">
                @php
                    $userInfo = [
                        'name' => 'নাম',
                        'email' => 'ইমেইল',
                        'phone' => 'ফোন নাম্বার',
                        'gender' => 'লিঙ্গ',
                        'blod_group' => 'রক্তের গ্রুপ',
                        'date_of_birth' => 'জন্ম তারিখ',
                        'petitions' => 'পেশা',
                        'group_class' => 'ক্লাস',
                        'department' => 'ডিপার্টমেন্ট',
                        'status' => 'অবস্থা',
                    ];
                @endphp
                @if ($userInfo)
                    @foreach ($userInfo as $key => $label)
                        <div
                            class="flex items-center border p-2 border-gray-300 rounded-base border-b-0 last:border-b text-sm">
                            <span class="min-w-[20%] text-right pr-2 font-semibold">{{ $label }}ঃ</span>
                            <span>
                                @if ($key == 'gender')
                                    @if ($viewData->gender == 'male')
                                        পুরুষ
                                    @elseif ($viewData->gender == 'female')
                                        মহিলা
                                    @elseif ($viewData->gender == 'other')
                                        অন্যান্য
                                    @else
                                        অজানা
                                    @endif
                                @elseif ($key == 'status')
                                    @if ($viewData->status == 'active')
                                        সচল
                                    @elseif ($viewData->status == 'inactive')
                                        অচল
                                    @else
                                        অজানা
                                    @endif
                                @else
                                    {{ $viewData->$key ? $viewData->$key : 'নেই' }}
                                @endif
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </x-ui.model>

    {{-- deposit model --}}
    <x-ui.model model='{{ $Moneymodel }}' modelTitle='ছাত্র/ছাত্রীর জন্য ডিপোজিট' cardSize='400px'
        controller='Moneymodelhandler'>
        @if ($moneyModeldata)
            <div class="flex justify-between gap-3 border-b border-gray-200 pb-3 mb-3">
                <div>
                    <h2 class="text-sm font-semibold text-dark">{{ $moneyModeldata->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $moneyModeldata->email }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-dark text-end">বর্তমান ব্যালেন্সঃ-
                        ৳{{ formatToBangla((float)$moneyModeldata->amount) }}
                        টাকা</h2>
                    <p class="text-[10px] text-gray-500 text-end">নতুন ব্যালেন্সঃ-
                        ৳{{ formatToBangla((float)$moneyModeldata->amount) }} +
                        ৳{{ formatToBangla((float)$deposit_amount) }} =
                        ৳{{ formatToBangla((float) $moneyModeldata->amount + (float) $deposit_amount) }} টাকা </p>
                </div>
            </div>
            <form wire:submit.prevent="depositNow">
                <div class="flex flex-col gap-3">
                    <x-ui.input step='0.01' label='পরিমান*' wire:model.live='deposit_amount'
                        target='deposit_amount' />
                    <x-ui.button text='যুক্ত করুন' type='submit' target='depositNow' class="justify-center" />
                </div>
            </form>
        @endif
    </x-ui.model>
</div>
