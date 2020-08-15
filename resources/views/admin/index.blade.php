@extends('layout')

@section('head')
<link href="{{ asset('admin.css') }}" rel="stylesheet">
@endsection

@section('title')
    Admin
@endsection

@section('content')
    <ome-app
        api-host="{{ config('app.api_url') }}"
        bearer="{{ $bearer }}"
    >
        <admin-app></admin-app>
    </ome-app>
@endsection

@section('scripts')
    <script src="{{ asset('admin.js') }}"></script>
@endsection
