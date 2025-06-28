@extends('root')
@section('title', '404 পেজ')
@section('root')
    <div class="w-full h-screen flex items-center justify-center overflow-hidden relative">
        <div>
            <img src="{{ get_media('404.png') }}" class="h-[300px]">
            <x-ui.button text='হোম এ ফিরে যান' href="ui.home" class="w-fit mx-auto"/>
        </div>

        <div class="fixed z-[-1] hidden md:flex -top-30 opacity-25 -right-30 w-96 h-96 bg-primary blur-3xl"></div>
        <div class="fixed z-[-1] -bottom-62 opacity-25 -left-62 w-96 h-96 bg-secondary blur-3xl"></div>
    </div>
@endsection
