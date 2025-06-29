<div class="w-full h-screen flex flex-col items-center justify-center relative">
    <div class="safearea py-5 absolute top-0 left-1/2 -translate-x-1/2">
        <x-ui.button href='ui.home' size='sm' variant='action' text='ফিরে যান' iconclass='ri-arrow-left-line'
            iconposition='left' />
    </div>

    <div class="safearea justify-center">
        <div class="w-full md:w-[350px]">
            <div class="w-full md:w-[60%] mx-auto">
                <h1 class="text-dark font-black text-center text-lg">নতুন পাসওয়ার্ড সেট করুন</h1>
                <p class="text-center text-gray-600 text-sm">নিচে আপনার নতুন পাসওয়ার্ড লিখুন এবং নিশ্চিত করুন।</p>
            </div>

            <div class="flex flex-col gap-4 mt-4">
                <x-ui.alert/>

                <form wire:submit.prevent="resetpassword" class="flex flex-col gap-4">
                    <x-ui.input wire:model='password' target='password' label='নতুন পাসওয়ার্ড*' type='password' class='w-full'
                        hint='******' />
                    <x-ui.input wire:model='password_confirmation' target='password_confirmation' label='আবার দিন পাসওয়ার্ড*' type='password' class='w-full'
                        hint='******' />
                    <x-ui.button target='resetpassword' type='submit' text='পরিবর্তন করুন' class="justify-center" />
                </form>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('ui.login') }}" wire:navigate
                    class="text-sm text-dark font-semibold duration-300 hover:text-primary">পাসওয়ার্ড মনে আছে?</a>
            </div>
        </div>
    </div>

    <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
    <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
</div>
