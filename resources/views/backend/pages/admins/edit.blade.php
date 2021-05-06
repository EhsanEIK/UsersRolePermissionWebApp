@extends('backend.layouts.master')
@section('title', 'Admin | Edit')

@section('style')
    <style>
        .form-check-label{
            text-transform: capitalize;
        }
    </style>
@endsection
@section('main_content')
<div class="main-content">
    <div class="main-content-inner">
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Admin</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route ('admin.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route ('admin.admins.index') }}">All Admins</a></li>
                            <li><span>Edit Admin</span></li>
                        </ul>
                    </div>
                </div>
                @include('backend.layouts.partial.profile')
            </div>
        </div>
        <!-- page title area end -->

        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        @include('backend.layouts.partial.message')
                        <h4 class="header-title">Edit {{ $admin->name }}</h4>
                        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="Enter a Admin name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">E-mail <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $admin->email }}" placeholder="Enter a email address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="roles">Assign Roles </label>
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $admin->hasRole($role->name)?'selected':'' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user_name">User Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $admin->user_name }}" placeholder="Enter a user name" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection