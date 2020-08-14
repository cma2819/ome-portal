@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('title')
    Top
@endsection

@section('content')
    <ome-app
        api-host="{{ config('app.api_url') }}"
        bearer="{{ $bearer }}"
        login-url="{{ $discord_oauth_url }}"
    ></ome-app>
@endsection

@section('scripts')
    <script src="{{ asset('index.js') }}"></script>
@endsection
