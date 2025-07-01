<div class="flex flex-col gap-4">
    <div class="flex items-center gap-2">
        @php
            $siteBtn = $tabActive == 'site' ? 'primary' : 'action-primary';
            $contactBtn = $tabActive == 'contact' ? 'primary' : 'action-primary';
            $seoBtn = $tabActive == 'seo' ? 'primary' : 'action-primary';
            $othersBtn = $tabActive == 'others' ? 'primary' : 'action-primary';
        @endphp
        <x-ui.button wire:click="tabSwithc('site')" text='সাইট তথ্য' size='sm' :variant="$siteBtn" />
        <x-ui.button wire:click="tabSwithc('contact')" text='যোগাযোগ তথ্য' size='sm' :variant="$contactBtn" />
        <x-ui.button wire:click="tabSwithc('seo')" text='SEO তথ্য' size='sm' :variant="$seoBtn" />
        <x-ui.button wire:click="tabSwithc('others')" text='অনান্য' size='sm' :variant="$othersBtn" />
    </div>

    {{-- site info --}}
    @if ($tabActive == 'site')
        <div class="bg-white p-4 rounded-base h-fit">
            <h1 class="text-sm text-gray-500 font-semibold">সাইট-এর তথ্য</h1>
            <form wire:submit.prevent="siteDataUpdate" class="w-full">
                <div class="mt-4 flex flex-col gap-4">
                    <x-ui.alert />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label='সাইটের নাম' wire:model='site_name' target='site_name' />
                        <x-ui.input label='সাইটের টাইটেল' wire:model='site_title' target='site_title' />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <div class="absolute top-0 right-0 flex items-center gap-x-2">
                                <i class="ri-loader-2-line animate-spin" wire:loading wire:target='logo'></i>
                            </div>
                            @if ($logo)
                                <div class="bg-gray-200 mb-2 rounded-base p-2">
                                    <img src="{{ $logo->temporaryUrl() }}" alt="Favicon Preview" class="h-8 w-auto" />
                                </div>
                            @endif
                            @if ($oldLogo)
                                <div class="bg-gray-200 mb-2 rounded-base p-2">
                                    <img src="{{ $oldLogo ? asset('storage/' . $oldLogo) : get_media() }}"
                                        alt="Favicon Preview" class="h-8 w-auto" />
                                </div>
                            @endif
                            <x-ui.input label='লোগো লাইট' id='logo' accept='image/*' type='file'
                                wire:model='logo' target='logo' />
                        </div>
                        <div class="relative">
                            <div class="absolute top-0 right-0 flex items-center gap-x-2">
                                <i class="ri-loader-2-line animate-spin" wire:loading wire:target='favicon'></i>
                            </div>
                            @if ($favicon)
                                <div class="bg-gray-200 mb-2 rounded-base p-2">
                                    <img src="{{ $favicon->temporaryUrl() }}" alt="Favicon Preview"
                                        class="h-8 w-auto" />
                                </div>
                            @endif
                            @if ($oldFavicon)
                                <div class="bg-gray-200 mb-2 rounded-base p-2">
                                    <img src="{{ $oldFavicon ? asset('storage/' . $oldFavicon) : get_media() }}"
                                        alt="Favicon Preview" class="h-8 w-auto" />
                                </div>
                            @endif
                            <x-ui.input label='ফেভিকন' id='favicon' accept='image/*' type='file'
                                wire:model='favicon' target='favicon' />
                        </div>
                    </div>
                    <x-ui.button type='submit' text='সেভ করুন' target='siteDataUpdate' class='w-fit' />
                </div>
            </form>
        </div>
    @endif

    {{-- contact info --}}
    @if ($tabActive == 'contact')
        <div class="bg-white p-4 rounded-base h-fit">
            <h1 class="text-sm text-gray-500 font-semibold">যোগাযোগ তথ্য</h1>
            <form wire:submit.prevent="contactUpdate" class="w-full">
                <div class="mt-4 flex flex-col gap-4">
                    <x-ui.alert />
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-ui.input label='ইমেইল' type='email' wire:model='email' target='email' />
                        <x-ui.input label='ফোন নাম্বার' type='text' wire:model='phone_1' target='phone_1' />
                        <x-ui.input label='ফোন নাম্বার (বিকল্প)' type='text' wire:model='phone_2' target='phone_2' />
                    </div>
                    <x-ui.input textarea='true' label='ঠিকানা' wire:model='address' target='address' />
                    <x-ui.input textarea='true' label='গুগোল ম্যাপ' wire:model='map' target='map' />
                    <x-ui.button type='submit' text='সেভ করুন' target='contactUpdate' class='w-fit' />
                </div>
            </form>
        </div>
        <div class="bg-white p-4 rounded-base h-fit">
            <h1 class="text-sm text-gray-500 font-semibold">সোসাল লিংক</h1>
            <div class="flex flex-col gap-4 mt-4">
                <x-ui.alert />
                <form wire:submit.prevent='socialLinkUpdate' class="w-full">
                    <div class="grid grid-cols-1 items-end md:grid-cols-3 gap-4">
                        <x-ui.select label='আইকন' :dataoption="$socialIcons" wire:model='social_icon'
                            target='social_icon' />
                        <x-ui.input label='লিংক*' wire:model='social_link' target='social_link' />
                        <x-ui.button type='submit' text='সেভ করুন' target='socialLinkUpdate'
                            class='justify-center h-fit' />
                    </div>
                </form>

                <div class="mt-3 flex flex-wrap gap-3 w-full">
                    @if ($socialLinksList)
                        @foreach ($socialLinksList as $icon => $url)
                            <div class="bg-gray-100 rounded-base h-8 min-w-8 flex items-center justify-center px-3">
                                <i class="{{ $icon }} border-r border-gray-200 pr-2"></i>
                                <div class="flex items-center gap-3 pl-3">
                                    <button type="button" wire:click="editSocialLink('{{ $icon }}')"><i
                                            class="ri-pencil-line text-sm text-dark"></i></button>
                                    <button type="button" wire:click="deleteSocialLink('{{ $icon }}')"><i
                                            class="ri-delete-bin-line text-sm text-red-500"></i></button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- seo info --}}
    @if ($tabActive == 'seo')
        <div class="bg-white p-4 rounded-base h-fit">
            <h1 class="text-sm text-gray-500 font-semibold">SEO তথ্য</h1>
            <form wire:submit.prevent="seoUpdate" class="w-full">
                <div class="mt-4 flex flex-col gap-4">
                    <x-ui.alert />
                    <x-ui.input label='মেটা টাইটেল' wire:model='meta_title' target='meta_title' />
                    <x-ui.input textarea='true' label='মেটা বর্ণনা' wire:model='meta_description'
                        target='meta_description' />
                    <x-ui.input textarea='true' label='মেটা কীওয়ার্ড (কমা, দিয়ে লিখুন)' wire:model='meta_keywords'
                        target='meta_keywords' />
                    <x-ui.button type='submit' text='সেভ করুন' target='seoUpdate' class='w-fit' />
                </div>
            </form>
        </div>
    @endif

    {{-- mode --}}
    @if ($tabActive == 'others')
        <div class="bg-white p-4 rounded-base h-fit flex items-center justify-between">
            <div>
                <h1 class="text-sm text-gray-500 font-semibold">রক্ষণাবেক্ষণ মোড</h1>
                <p class="text-xs text-gray-400 mt-1">সাইটটি আপডেট বা মেরামতের জন্য সাময়িকভাবে বন্ধ রাখতে এই মোডটি
                    চালু
                    করুন।</p>
            </div>
            <div>
                <div class="flex items-center justify-center border border-gray-200 rounded-base w-fit">
                    <button wire:click="changestatus(true)" {{ $siteMode ? 'disabled' : '' }}
                        class="text-[10px] px-2 h-6  {{ $siteMode ? ' cursor-not-allowed bg-green-200' : 'bg-gray-200' }}">চালু</button>

                    <button wire:click="changestatus(false)" {{ !$siteMode ? 'disabled' : '' }}
                        class="text-[10px] px-2 h-6 border-l border-white {{ !$siteMode ? 'cursor-not-allowed bg-red-200' : ' bg-gray-200' }}">বন্ধ</button>
                </div>
            </div>
        </div>
    @endif
</div>
