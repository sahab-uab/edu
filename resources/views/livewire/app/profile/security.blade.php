<div class="flex flex-col md:flex-row gap-3">
    <form wire:submit.prevtn="passwordUpdate" class="bg-white p-4 rounded-base flex flex-col gap-4 w-full md:w-1/2">
        <h2 class="text-gray-500 text-base">পাসওয়ার্ড পরিবর্তন</h2>
        <x-ui.alert />
        <x-ui.input type='password' label='নতুন পাসওয়ার্ড*' wire:model='password' target='password' />
        <x-ui.input type='password' label='নতুন পাসওয়ার্ড নিশ্চিত করুন*' wire:model='password_confirmation'
            target='password_confirmation' />
        <x-ui.button text='আপডেট করুন' type='submit' class='justify-center' target='passwordUpdate' />
    </form>
    {{-- email --}}
    <form wire:submit.prevtn="emailUpdate" class="bg-white p-4 rounded-base flex flex-col gap-4 w-full md:w-1/2">
        <h2 class="text-gray-500 text-base">ইমেইল পরিবর্তন</h2>
        <x-ui.alert />
        <x-ui.input type='email' label='নতুন ইমেইল*' wire:model='new_email' target='new_email' />
        <x-ui.input type='password' label='নতুন পাসওয়ার্ড*' wire:model='current_password' target='current_password' />
        <x-ui.button text='আপডেট করুন' type='submit' class='justify-center' target='emailUpdate' />
    </form>
</div>
