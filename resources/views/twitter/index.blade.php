@extends('layout')

@section('head')
<link href="{{ asset('twitter.css') }}" rel="stylesheet">
@endsection

@section('title')
    Twitter App
@endsection

@section('content')
    <twitter-app></twitter-app>
@endsection

@section('scripts')
    <script src="{{ asset('twitter.js') }}"></script>
@endsection
