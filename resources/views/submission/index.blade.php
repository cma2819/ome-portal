@extends('layout')

@section('head')
<link href="{{ asset('index.css') }}" rel="stylesheet">
<link href="{{ asset('submission.css') }}" rel="stylesheet">
@endsection

@section('title')
    Submission
@endsection

@section('content')
    <submission-app></submission-app>
@endsection

@section('scripts')
    <script src="{{ asset('submission.js') }}"></script>
@endsection
