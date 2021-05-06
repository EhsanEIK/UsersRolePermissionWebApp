@extends('backend.layouts.master')
@section('title', 'Welcome')
@section('main_content')

<div class="main-content-inner">
    <div class="container mt-4">
        <h2>Welcome {{ Auth::guard('admin')->user()->name }}</h2>
    </div>
</div>
@endsection