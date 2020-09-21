@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
<link href="{{ asset('streamInternal.css') }}" rel="stylesheet">
@endsection

@section('title')
    Internal Stream Viewer
@endsection

@section('content')
    <stream-internal-app
        stream-id="{{ $streamId }}"
        stream-uri="{{ $streamUri }}"
    ></stream-internal-app>
@endsection

@section('scripts')
    <script src="{{ asset('streamInternal.js') }}"></script>
@endsection
