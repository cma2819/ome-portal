@extends('layout')

@section('head')
<link href="{{ asset('twitter.css') }}" rel="stylesheet">
@endsection

@section('title')
    Twitter App
@endsection

@section('content')
    <ome-app api-host="{{ config('app.api_url') }}">
        <twitter-app></twitter-app>
    </ome-app>
@endsection

@section('scripts')
    <script src="{{ asset('twitter.js') }}"></script>
@endsection
