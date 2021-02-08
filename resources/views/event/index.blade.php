@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
<link href="{{ asset('event.css') }}" rel="stylesheet">
@endsection

@section('title')
    Event
@endsection

@section('content')
    <event-app></event-app>
@endsection

@section('scripts')
    <script src="{{ asset('event.js') }}"></script>
@endsection
