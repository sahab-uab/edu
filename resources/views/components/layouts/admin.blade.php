@extends('root')
@section('title')
    {{ $title ?? 'Page Title' }}
@endsection
@section('root')
    <div class="flex w-full h-screen bg-gray-100">
        <x-parts.ux.sidebar />
        <div class="w-full flex flex-col overflow-auto" id="mainbody">
            <x-parts.ux.header title="{{ $title }}" />
            <div class="p-4 overflow-auto max-h-[calc(100%-50px)]">
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection
