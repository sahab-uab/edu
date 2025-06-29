<div class="w-full h-screen flex flex-col items-center justify-center relative">
    <div class="safearea py-5 absolute top-0 left-1/2 -translate-x-1/2">
        <x-ui.button href='ui.home' size='sm' variant='action' text='ফিরে যান' iconclass='ri-arrow-left-line'
            iconposition='left' />
    </div>

    <div class="safearea justify-center">
        <div class="w-full md:w-[350px]">
            <div class="w-full md:w-[60%] mx-auto">
                <h1 class="text-dark font-black text-center text-lg">ফিরে আসায় অভিনন্দন!</h1>
                <p class="text-center text-gray-600 text-sm">আবার স্বাগতম! আপনার অ্যাকাউন্টে প্রবেশ করুন ও অন্বেষণ শুরু
                    করুন।</p>
            </div>

            <div class="flex flex-col gap-4 mt-4">
                <a href="{{ route('google.redirect') }}" class="btn border border-gray-200 bg-gray-50 justify-center">
                    <i class="ri-google-fill"></i>
                    <span>গুগল দিয়ে লগিন করুন</span>
                </a>
                <div class="flex items-center justify-between my-2">
                    <div class="w-full h-[1px] border-b border-gray-300"></div>
                    <span class="mx-5 text-sm font-semibold text-gray-500">আথবা</span>
                    <div class="w-full h-[1px] border-b border-gray-300"></div>
                </div>

                <x-ui.alert/>

                <form wire:submit.prevent="login" class="flex flex-col gap-4">
                    <x-ui.input wire:model='email' target='email' label='ইমেইল' type='email' class='w-full'
                        hint='ইমেইল দিন' />
                    <div class="flex flex-col">
                        <a href="{{ route('ui.forgate') }}" wire:navigate
                            class="text-sm -mb-4.5 z-[10] text-dark text-right font-semibold duration-300 hover:text-primary">পাসওয়ার্ড
                            ভুলে গেছেন?</a>
                        <x-ui.input wire:model='password' target='password' label='পাসওয়ার্ড' type='password'
                            class='w-full' hint='পাসওয়ার্ড দিন' />
                    </div>
                    <x-ui.button target='login' type='submit' text='লগইন করুন' class="justify-center" />
                </form>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('ui.signup') }}" wire:navigate
                    class="text-sm text-dark font-semibold duration-300 hover:text-primary">নতুন একাউন্ট
                    তৈরী করুন</a>
            </div>
        </div>
    </div>

    <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
    <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
</div>
