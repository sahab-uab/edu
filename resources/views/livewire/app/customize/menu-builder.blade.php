<div class="flex flex-col md:flex-row gap-3">
    {{-- form --}}
    <div class="bg-white p-4 rounded-base w-full md:w-[30%] h-fit">
        <div class="border-b border-gray-200 pb-3 mb-3">
            <h2 class="text-base font-semibold text-gray-800">নতুন মেনু তৈরি করুন</h2>
        </div>
        <form wire:submit.prevent="store">
            <div class="flex flex-col gap-3">
                @php
                    $dataoptions = [
                        '_self' => 'একই পেজে',
                        '_blank' => 'নতুন পেজে',
                    ];
                @endphp
                <x-ui.input label='মেনু নাম*' hint='মেনু নাম' wire:model='menu_name' target='menu_name' />
                <x-ui.input label='মেনু লিংক*' hint='মেনু লিংক' wire:model='menu_link' target='menu_link' />
                <x-ui.select label='পেজ*' :dataoption="$dataoptions" wire:model="menu_target" target="menu_target" />
                <x-ui.button target='store' text='সেভ করুন' type='submit' class="justify-center" />
            </div>
        </form>
    </div>

    {{-- data --}}
    <div class="bg-white p-4 rounded-base w-full md:w-[70%] h-fit">
        <div class="border-b border-gray-200 pb-3 mb-3">
            <h2 class="text-base font-semibold text-gray-800">প্রাইমারি মেনু</h2>
            <p class="text-sm text-gray-500">এখানে আপনার মেনু আইটেমগুলো কাস্টমাইজ করুন। নতুন আইটেম যোগ করতে বা বিদ্যমান
                আইটেম সম্পাদনা করতে ফর্মটি ব্যবহার করুন।</p>
        </div>
        <x-ui.alert />
        <div class="flex flex-col gap-1">
            <div x-data="menuSortable" x-init="init()"
                @item-moved.window="Livewire.dispatch('itemMoved', $event.detail)">
                <div id="menu-nested">
                    @foreach ($menus as $menu)
                        <div class="menu-item" data-id="{{ $menu->id }}">
                            <div class="border border-gray-200 rounded-base px-3 py-2 flex items-start gap-3 mb-1">
                                <button class="text-gray-500 cursor-move min-w-fit">
                                    <i class="ri-drag-move-line"></i>
                                </button>
                                <div class="w-full">
                                    <div class="flex items-start justify-between">
                                        <div class="text-base text-dark flex items-center gap-1">
                                            <div class="text-dark font-medium">{{ $menu->title }}</div>
                                            <small class="text-gray-500">({{ $menu->url }})</small>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <button wire:click='edit({{ $menu->id }})'
                                                class="w-[20px] h-[20px] flex items-center justify-center hover:bg-gray-100 rounded-base text-base text-gray-500 duration-300 hover:text-dark"><i
                                                    class="ri-pencil-line"></i></button>
                                            <button wire:click="delete({{ $menu->id }})"
                                                wire:confirm="আপনি কি নিশ্চিতভাবে এই মেনুটি মুছে ফেলতে চান? সাব-মেনু থাকলে সেগুলোও মুছে যাবে।"
                                                class="w-[20px] h-[20px] flex items-center justify-center hover:bg-gray-100 rounded-base text-base text-gray-500 duration-300 hover:text-red-500">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="submenu mt-2" data-parent-id="{{ $menu->id }}">
                                        @foreach ($menu->children as $child)
                                            <div class="menu-item" data-id="{{ $child->id }}">
                                                <div
                                                    class="border border-gray-100 rounded-base px-3 py-2 flex gap-3 mb-1">
                                                    <button class="text-gray-500 cursor-move">
                                                        <i class="ri-drag-move-line"></i>
                                                    </button>
                                                    <div class="flex items-center justify-between w-full">
                                                        <div class="text-base text-dark flex items-center gap-1">
                                                            <div class="text-dark">{{ $child->title }}</div>
                                                            <small class="text-gray-500">({{ $child->url }})</small>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <button wire:click='edit({{ $child->id }})'
                                                                class="w-[20px] h-[20px] flex items-center justify-center hover:bg-gray-100 rounded-base text-base text-gray-500 duration-300 hover:text-dark"><i
                                                                    class="ri-pencil-line"></i></button>
                                                            <button wire:click="delete({{ $child->id }})"
                                                                wire:confirm="আপনি কি নিশ্চিতভাবে এই সাব-মেনুটি মুছে ফেলতে চান?"
                                                                class="w-[20px] h-[20px] flex items-center justify-center hover:bg-gray-100 rounded-base text-base text-gray-500 duration-300 hover:text-red-500"><i
                                                                    class="ri-delete-bin-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        function dragEnable() {
            Alpine.data('menuSortable', () => ({
                init() {
                    const mainList = document.getElementById('menu-nested');

                    this.makeSortable(mainList);

                    document.querySelectorAll('.submenu').forEach(sub => {
                        this.makeSortable(sub);
                    });
                },

                makeSortable(element) {
                    new Sortable(element, {
                        group: 'nested',
                        animation: 150,
                        handle: '.cursor-move',
                        onEnd: (evt) => {
                            const itemId = evt.item.dataset.id;
                            const parentDiv = evt.to.closest('.submenu');
                            const parentId = parentDiv ? parentDiv.dataset.parentId : null;

                            const order = [];
                            evt.to.querySelectorAll('.menu-item').forEach((el, index) => {
                                order.push({
                                    id: el.dataset.id,
                                    position: index + 1
                                });
                            });

                            window.dispatchEvent(new CustomEvent('item-moved', {
                                detail: {
                                    itemId: itemId,
                                    parentId: parentId,
                                    order: order
                                }
                            }));
                        }
                    });
                }
            }))
        }
        document.addEventListener('alpine:init', () => {
            dragEnable();
        });
        document.addEventListener('livewire:init', () => {
            dragEnable();
            document.addEventListener('livewire:navigated', () => {
                dragEnable();
            });
        });
    </script>
@endpush
