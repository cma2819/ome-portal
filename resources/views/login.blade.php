@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('title')
    Login
@endsection

@section('content')
    <login-app></login-app>
@endsection

@section('scripts')
    <script src="{{ asset('login.js') }}"></script>
@endsection
