@extends('backend.layouts.master')
@section('title', 'Role | Index')
@section('style')
    <style>
        .badge,td{
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
                            <li><span>All Roles</span></li>
                        </ul>
                    </div>
                </div>
                @include('backend.layouts.partial.profile')
            </div>
        </div>
        <!-- page title area end -->

        @include('backend.layouts.partial.message')
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title">Roles List</h4>
                            </div>
                            @if (Auth::guard('admin')->user()->can('role.create'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-xs mb-3 ">Create New Role</a>
                                </div>
                            @endif
                        </div>
                        
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th width="500px">Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role )
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission )
                                                    <span class="badge badge-success mr-2">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.roles.destroy', [$role->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @if (Auth::guard('admin')->user()->can('role.edit'))
                                                        <a href="{{ route('admin.roles.edit', [$role->id]) }}" class="btn btn-primary btn-xs text-white">Edit</a>
                                                    @endif

                                                    @if (Auth::guard('admin')->user()->can('role.delete'))
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs text-white">Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>
@endsection
