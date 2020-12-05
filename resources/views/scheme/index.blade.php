@extends('layout')

@section('head')
<link href="{{ asset('scheme.css') }}" rel="stylesheet">
@endsection

@section('title')
    Scheme
@endsection

@section('content')
    <scheme-app></scheme-app>
@endsection

@section('scripts')
    <script src="{{ asset('scheme.js') }}"></script>
@endsection
