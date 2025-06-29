<div class="flex flex-col md:flex-row gap-3">
    <div class="bg-white p-4 rounded-base w-full md:w-[70%] h-fit">
        <form wire:submit.prevent="store" class="flex flex-col gap-3">
            <x-ui.alert />
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <x-ui.input label='মেইলার*' hint='smtp' target='mailer' wire:model='mailer' />
                <x-ui.input label='হোস্ট*' hint='smtp.gmail.com' target='host' wire:model='host' />
                <x-ui.input label='পোর্ট*' type='number' hint='587' target='port' wire:model='port' />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <x-ui.input label='ইউজার নাম*' type='email' hint='demo@gmail.com' target='username'
                    wire:model='username' />
                <x-ui.input label='পাসওয়ার্ড*' hint='12345678' target='password' wire:model='password' />
                <x-ui.input label='এনক্রিপশন*' hint='tls' target='encryption' wire:model='encryption' />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <x-ui.input label='ইমেইল ঠিকানা*' type='email' hint='demo@gmail.com' target='from_address'
                    wire:model='from_address' />
                <x-ui.input label='কোম্পানি নাম*' hint='education' target='from_name' wire:model='from_name' />
            </div>
            <x-ui.button type='submit' text='সেভ করুন' target='store' class="w-fit" />
        </form>
    </div>

    <div class="bg-white p-4 rounded-base w-full md:w-[30%] h-fit">
        <form wire:submit.prevent="testemail" class='flex flex-col gap-3'>
            <div>
                <h1 class="text-base font-semibold text-gray-800">পরীক্ষামূলক ইমেইল পাঠান</h1>
                <p class="text-sm text-gray-600">আপনার ইমেইল সেটিংস সঠিকভাবে কাজ করছে কিনা যাচাই করতে এখানে একটি
                    পরীক্ষামূলক
                    ইমেইল পাঠান।</p>
            </div>
            <x-ui.input label='ইমেইল*' type='email' wire:model='test_email' target='test_email' />
            @if ($redyfortest == 'false')
                <x-ui.button target='testemail' type='submit' text='সেটিংস পরিবর্তন করুন' class='justify-center'
                    disabled />
            @else
                <x-ui.button target='testemail' type='submit' text='ইমেইল পাঠান' class='justify-center' />
            @endif
        </form>
    </div>
</div>
