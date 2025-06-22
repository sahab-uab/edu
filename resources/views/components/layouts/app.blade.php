@extends('root')
@section('title')
    {{ $title ?? 'Page Title' }}
@endsection
@section('root')
    <x-parts.ui.navbar />
    {{ $slot }}
    <x-parts.ui.footer />
@endsection
