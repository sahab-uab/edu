<div class="w-full h-screen flex flex-col items-center justify-center relative">
    <div class="safearea py-5 absolute top-0 left-1/2 -translate-x-1/2">
        <x-ui.button href='ui.home' size='sm' variant='action' text='ফিরে যান' iconclass='ri-arrow-left-line'
            iconposition='left' />
    </div>

    <div class="safearea justify-center">
        <div class="w-full md:w-[350px]">
            <div class="w-full md:w-[60%] mx-auto">
                <h1 class="text-dark font-black text-center text-lg">পাসওয়ার্ড ভুলে গেছেন?</h1>
                <p class="text-center text-gray-600 text-sm">আপনার ইমেইল দিন, আমরা পাসওয়ার্ড রিসেটের নির্দেশনা পাঠাবো।</p>
            </div>

            <div class="flex flex-col gap-4 mt-4">
                <x-ui.alert/>

                <form wire:submit.prevent="forget" class="flex flex-col gap-4">
                    <x-ui.input wire:model='email' target='email' label='ইমেইল' type='email' class='w-full'
                        hint='ইমেইল দিন' />
                    <x-ui.button target='forget' type='submit' text='ইমেইল পাঠান' class="justify-center" />
                </form>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('ui.login') }}" wire:navigate
                    class="text-sm text-dark font-semibold duration-300 hover:text-primary">আমার একাউন্ট আছে</a>
            </div>
        </div>
    </div>

    <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
    <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
</div>
