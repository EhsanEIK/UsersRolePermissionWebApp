@extends('errors.error_layout_master')
@section('title', '403 | Forbidden')
@section('error_content')
    <div class="error-content">
        <h2>403</h2>
        <p>Access to this resource on the server is denied</p>
        <hr>
        <p>{{ $exception->getMessage() }}</p>
        <a href="{{ route('welcome') }}">Back Welcome Page</a>
        <a href="{{ route('admin.login') }}">Log In</a>
    </div>
@endsection
