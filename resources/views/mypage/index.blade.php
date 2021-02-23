@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
<link href="{{ asset('mypage.css') }}" rel="stylesheet">
@endsection

@section('title')
    Mypage
@endsection

@section('content')
    <mypage-app
        twitch-auth-url={{ $twitch_oauth_url }}
    ></mypage-app>
@endsection

@section('scripts')
    <script src="{{ asset('mypage.js') }}"></script>
@endsection
