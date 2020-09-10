@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('title')
    Top
@endsection

@section('content')
    <top-app></top-app>
@endsection

@section('scripts')
    <script src="{{ asset('index.js') }}"></script>
@endsection
