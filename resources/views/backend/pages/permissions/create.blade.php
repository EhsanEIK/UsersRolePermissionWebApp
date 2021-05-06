@extends('backend.layouts.master')
@section('title', 'Permissions - Create')
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
                            <li><a href="{{ route ('admin.permissions.index') }}">All Permissions</a></li>
                            <li><span>Create Permission</span></li>
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
                        <h4 class="header-title">Create Admin</h4>
                        <form action="{{ route('admin.permissions.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="group_name" class="col-sm-2 col-form-label">Group Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Permission Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permission Name" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>
@endsection