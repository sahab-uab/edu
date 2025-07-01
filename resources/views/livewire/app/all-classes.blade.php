<div class="bg-white p-4 rounded-base">
    {{-- header --}}
    <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
        <div class="flex items-center gap-2">
            <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
        </div>
        <x-ui.button wire:click='modelhandler' target='modelhandler' text='নতুন ক্লাস' iconclass='ri-add-line'
            iconposition='left' size='xsm' class='hidden md:flex' />
        <x-ui.button wire:click='modelhandler' class='md:hidden' target='modelhandler' text=''
            iconclass='ri-add-line' iconposition='left' size='xsm' />
    </div>

    <x-ui.alert />

    {{-- header end --}}
    <div class="overflow-auto">
        @if ($data && count($data) > 0)
            <table class="min-w-full mt-4 rounded-base overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">ক্লাস
                            আইডি
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">ক্লাস
                            নাম
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">সর্বমোট
                            বিষয়
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">সর্বমোট
                            অধ্যায়
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
                            <td class="px-4 text-base py-3 whitespace-nowrap text-gray-600 font-semibold">
                                {{ $item->name }}
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                {{ formatToBangla($item->subject_count) }} টি
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                {{ formatToBangla($item->lession_count) }} টি
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                <div class="flex items-center">
                                    <button wire:click='edit({{ $item->id }})' class="py-1 px-2">
                                        <i class="ri-pencil-line text-blue-500"></i>
                                    </button>
                                    <button
                                        x-data
                                        @click.prevent="
                                            if (confirm('আপনি কি নিশ্চিত যে আপনি এই ক্লাসটি মুছে ফেলতে চান?\nবিঃদ্রঃ- আপনার এই ক্লাস এর সাথে সংশ্লিষ্ট সকল তথ্য একেবারে মুছে যাবে।')) {
                                                $wire.delete({{ $item->id }});
                                            }
                                        "
                                        class="py-1 px-2"
                                        title="মুছে ফেলুন"
                                    >
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
                <p class="text-base font-semibold text-gray-500 mt-2">কোন ক্লাস পাওয়া যায়নি!</p>
                <x-ui.button wire:click='modelhandler' target='modelhandler' text='নতুন ক্লাস' iconclass='ri-add-line'
                    iconposition='left' size='xsm' class='mt-3' />
            </div>
        @endif
        <div class="mt-6 flex items-center justify-end">
            {{ $data->links('components.ui.pagination') }}
        </div>
    </div>

    {{-- add model --}}
    @php
        $modelTitle = $editId ? 'পরিবর্তন করুন' : 'নতুন ক্লাস';
    @endphp
    <x-ui.model model='{{ $model }}' modelTitle='{{ $modelTitle }}' cardSize='450px' controller='modelhandler'>
        <form wire:submit.prevent="classAdd">
            <div class="w-full flex flex-col gap-3">
                <x-ui.input target='name' wire:model='name' label='ক্লাস নাম' hint='নাম' />
                @php
                    $btnText = $editId ? 'পরিবর্তন করুন' : 'সেভ করুন';
                @endphp
                <x-ui.button target='studentAdd' type='submit' text='{{ $btnText }}' class="justify-center" />
            </div>
        </form>
    </x-ui.model>
</div>
