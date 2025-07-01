<div class="bg-white p-4 rounded-base">
    {{-- header --}}
    <div class="flex items-center justify-between gap-3 border-b border-dotted border-gray-200 pb-4">
        <div class="flex items-center gap-2">
            <x-ui.input size='sm' wire:model.live='search' type='search' hint='সার্চ করুন' />
        </div>
    </div>

    <x-ui.alert />

    {{-- header end --}}
    <div class="overflow-auto">
        @if ($data && count($data) > 0)
            <table class="min-w-full mt-4 rounded-base overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">লেনদেন
                            আইডি
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">ইউজার
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                            পরিমান
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                            পেমেন্টের মাধ্যম
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                            পেমেন্টের অবস্থা
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
                                <p class="text-sm text-dark">{{ $item->user->name }}</p>
                                <p class="text-sm">{{ $item->user->email }}</p>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                {{ formatToBangla($item->amount) }} টাকা
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                {{ $item->payment_gatway }}
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap">
                                <span class="text-sm text-center py-1 px-2 {{ $item->status =='success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}  rounded-base">
                                    {{ $item->status == 'success' ? 'সফল' : 'অসম্পন্ন' }}
                                </span>
                            </td>
                            <td class="px-4 text-base py-3 whitespace-nowrap text-center">
                                <div class="flex items-center">
                                    <button x-data
                                        @click.prevent="
                                            if (confirm('আপনি কি নিশ্চিত যে আপনি এই লেনদেনটি মুছে ফেলতে চান?')) {
                                                $wire.delete({{ $item->id }});
                                            }
                                        "
                                        class="py-1 px-2" title="মুছে ফেলুন">
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
                <p class="text-base font-semibold text-gray-500 mt-2">কোন লেনদেন পাওয়া যায়নি!</p>
            </div>
        @endif
        <div class="mt-6 flex items-center justify-end">
            {{ $data->links('components.ui.pagination') }}
        </div>
    </div>
</div>
