<div class="flex flex-col md:flex-row gap-4">
    <div class="bg-white p-4 rounded-base w-full md:w-[30%] h-fit">
        <h1 class="text-sm text-gray-400 font-semibold">নতুন প্রশ্নের ধরন যুক্ত করুন</h1>
        <form wire:submit.prevent="store">
            <div class="flex flex-col gap-3 mt-3">
                <x-ui.input wire:model='name' target='name' label='ধরন নাম' hint='নাম' />

                <x-ui.button type='submit' target='store' text='সেভ করুন' class='justify-center' />
                <button type="button" wire:click="clearfild"
                    class="text-base text-gray-500 text-center font-semibold duration-300 hover:text-primary">বাতিল
                    করুন</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-4 rounded-base w-full md:w-[70%]">
        {{-- header --}}
        <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
            <div class="flex items-center gap-2">
                <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
            </div>
        </div>
        <x-ui.alert />

        {{-- table --}}
        <div class="overflow-auto">
            @if ($data && count($data) > 0)
                <table class="min-w-full mt-4 rounded-base overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                নং
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                ধরনের নাম
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                                অ্যাকশন
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @foreach ($data as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 text-base py-3 whitespace-nowrap font-medium text-gray-800">
                                    {{ formatToBangla($index + 1) }}
                                </td>
                                <td class="px-4 text-base py-3 whitespace-nowrap text-gray-600 font-semibold">
                                    {{ $item->name }}
                                </td>
                                <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                    <div class="flex items-center">
                                        <button wire:click='edit({{ $item->id }})' class="py-1 px-2">
                                            <i class="ri-pencil-line text-blue-500"></i>
                                        </button>
                                        @if (Auth::user()->role == 'admin')
                                            <button wire:confirm="আপনি কি নিশ্চিত যে আপনি এই ধরনটি মুছে ফেলতে চান?"
                                                wire:click='delete({{ $item->id }})' class="py-1 px-2">
                                                <i class="ri-delete-bin-line text-red-500"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div
                    class="w-full flex flex-col items-center justify-center p-5 rounded-base border border-gray-100 mt-4">
                    <i class="ri-emotion-sad-line text-gray-500 text-3xl"></i>
                    <p class="text-base font-semibold text-gray-500 mt-2">কোন ধরন পাওয়া যায়নি!</p>
                </div>
            @endif
            <div class="mt-6 flex items-center justify-end">
                {{ $data->links('components.ui.pagination') }}
            </div>
        </div>
    </div>
</div>
