@extends('backend.layouts.master')
@section('title', 'Role | Create')

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
                        <h4 class="page-title pull-left">Role</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route ('admin.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route ('admin.roles.index') }}">All Roles</a></li>
                            <li><span>Create Role</span></li>
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
                        <h4 class="header-title">Create Role</h4>
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Role name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i=1; @endphp
                                @foreach ($permissionGroups as $permissionGroup)
                                    @php
                                        $permissions = App\Models\Admin::getPermissionByGroup($permissionGroup->name);
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $i }}-management" value="{{ $permissionGroup->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox',this)">
                                                <label class="form-check-label" for="{{ $i }}-management">{{ $permissionGroup->name }}</label>
                                            </div>  
                                        </div>
                                
                                        <div class="col-md-9 role-{{ $i }}-management-checkbox">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}-management', {{ count($permissions) }})" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                    <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
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
    @include('backend.pages.roles.partial.script')
@endsection