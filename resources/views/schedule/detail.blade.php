@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('title')
    Schedule
@endsection

@section('content')
    <ome-app
        api-host="{{ config('app.api_url') }}"
        bearer="{{ $bearer }}"
        login-url="{{ $discord_oauth_url }}"
    >
        <schedule-app></schedule-app>
    </ome-app>
@endsection

@section('scripts')
    <script src="{{ asset('schedule.js') }}"></script>
@endsection
