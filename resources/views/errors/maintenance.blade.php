@extends('root')
@section('title', '404 পেজ')
@section('root')
    <div class="w-full h-screen flex items-center justify-center overflow-hidden relative">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ get_media('maintenance.png') }}" class="w-[200px] h-auto">
            <h1 class="text-2xl font-semibold text-dark w-full md:w-[430px] text-center">
                দুঃখিত! আমরা বর্তমানে ওয়েবসাইটের রক্ষণাবেক্ষণ এবং আপডেটের কাজ চলতেছে।
            </h1>
            <p class="text-sm text-gray-500 mb-4 mt-1 w-full md:w-[380px] text-center">আমাদের ওয়েবসাইটটি আপডেট ও উন্নয়ন কাজের জন্য কিছু সময়ের জন্য বন্ধ রাখা হয়েছে।
                আমরা খুব শিগগিরই আবার সচল হবো।</p>
            <x-ui.button text='হোম এ ফিরে যান' href="ui.home" class="w-fit mx-auto" />
        </div>

        <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
        <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
    </div>
@endsection
