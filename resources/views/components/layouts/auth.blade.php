@extends('root')
@section('title')
    {{ $title ?? 'Page Title' }}
@endsection
@section('root')
    {{ $slot }}
@endsection
