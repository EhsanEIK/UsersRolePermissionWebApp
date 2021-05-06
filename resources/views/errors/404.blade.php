@extends('errors.error_layout_master')
@section('title', '404 | Page Error')
@section('error_content')
    <div class="error-content">
        <h2>404</h2>
        <p>Ooops! Something went wrong. Page not found!!</p>
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
        <a href="{{ route('admin.login') }}">Log In</a>
    </div>
@endsection