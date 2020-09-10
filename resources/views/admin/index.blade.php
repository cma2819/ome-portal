@extends('layout')

@section('head')
<link href="{{ asset('admin.css') }}" rel="stylesheet">
@endsection

@section('title')
    Admin
@endsection

@section('content')
    <admin-app></admin-app>
@endsection

@section('scripts')
    <script src="{{ asset('admin.js') }}"></script>
@endsection
