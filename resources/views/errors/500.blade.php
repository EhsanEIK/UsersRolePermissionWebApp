@extends('errors.error_layout_master')
@section('title', '500 | Server Error')
@section('error_content')
    <div class="error-content">
        <h2>500</h2>
        <p>Internal Server Error!</p>
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
        <a href="{{ route('admin.login') }}">Log In</a>
    </div>
@endsection