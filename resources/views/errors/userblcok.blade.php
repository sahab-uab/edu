@extends('root')
@section('title', '404 পেজ')
@section('root')
    <div class="w-full h-screen flex items-center justify-center overflow-hidden relative">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ get_media('userblock.png') }}" class="w-[200px] h-auto">
            <h1 class="text-2xl font-semibold text-dark w-full md:w-[430px] text-center">
                আপনার অ্যাকাউন্টটি ব্লক করা হয়েছে!
            </h1>
            <p class="text-sm text-gray-500 mb-4 mt-1 w-full md:w-[380px] text-center">
                দুঃখিত! প্রশাসকের সিদ্ধান্ত অনুযায়ী আপনার অ্যাকাউন্টটি সাময়িকভাবে ব্লক করা হয়েছে। বিস্তারিত জানতে প্রশাসকের সাথে যোগাযোগ করুন।
            </p>
            <x-ui.button text='হোম এ ফিরে যান' href="ui.home" class="w-fit mx-auto" />
        </div>

        <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
        <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
    </div>
@endsection
