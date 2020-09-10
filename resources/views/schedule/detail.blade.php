@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('title')
    Schedule
@endsection

@section('content')
    <schedule-app></schedule-app>
@endsection

@section('scripts')
    <script src="{{ asset('schedule.js') }}"></script>
@endsection
