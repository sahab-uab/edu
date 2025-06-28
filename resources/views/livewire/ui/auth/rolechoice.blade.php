<div class="w-full h-screen flex flex-col items-center justify-center relative">
    <div class="safearea py-5 absolute top-0 left-1/2 -translate-x-1/2">
        <x-ui.button href='ui.home' size='sm' variant='action' text='ফিরে যান' iconclass='ri-arrow-left-line'
            iconposition='left' />
    </div>

    <div class="safearea justify-center">
        <div class="w-full md:w-[350px]">
            <div class="w-full md:w-[60%] mx-auto">
                <h1 class="text-dark font-black text-center text-lg">ফিরে আসায় অভিনন্দন!</h1>
                <p class="text-center text-gray-600 text-sm">আপনার ভূমিকা নির্বাচন করুন এবং আপনার যাত্রা শুরু করুন।</p>
            </div>

            <div class="flex flex-col gap-4 mt-4">
                <x-ui.alert />

                <form wire:submit.prevent="updaterole" class="flex flex-col gap-4">
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input wire:change="setrole('student')" type="radio" name="option" class="hidden peer">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 peer-checked:bg-primary/5 flex flex-col items-center justify-center gap-1 peer-checked:border-primary duration-300">
                                <i class="ri-graduation-cap-line text-3xl text-gray-500"></i>
                                <span class="text-gray-500 font-semibold">ছাত্র/ছাত্রী</span>
                            </div>
                        </label>
                        <!-- Option 2 -->
                        <label class="cursor-pointer">
                            <input wire:change="setrole('teacher')" type="radio" name="option" class="hidden peer">
                            <div
                                class="p-4 hover:border-primary rounded-base border border-gray-200 peer-checked:bg-primary/5 flex flex-col items-center justify-center gap-1 peer-checked:border-primary duration-300">
                                <i class="ri-pencil-ruler-line text-3xl text-gray-500"></i>
                                <span class="text-gray-500 font-semibold">শিক্ষক</span>
                            </div>
                        </label>
                    </div>
                    @if (!empty(Auth::user()->google_id))
                        <x-ui.input wire:model='password' target='password' label='নতুন পাসওয়ার্ড' type='password'
                            class='w-full' hint='পাসওয়ার্ড দিন' />
                    @endif
                    <x-ui.button target='updaterole' type='submit' text='সামনে আগান' class="justify-center" />
                </form>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('logout') }}" wire:navigate
                    class="text-sm text-dark font-semibold duration-300 hover:text-primary">লগআউট হয়ে যান</a>
            </div>
        </div>
    </div>

    <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
    <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
</div>
