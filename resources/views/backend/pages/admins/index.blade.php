@extends('backend.layouts.master')
@section('title', 'Admin | Index')
@section('style')
    <style>
        .badge{
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
                            <li><span>All Admins</span></li>
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
                                <h4 class="header-title">Admins List</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                @if (Auth::guard('admin')->user()->can('admin.create'))
                                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-xs mb-3 ">Create New Admin</a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>E-mail</th>
                                        <th width="100px">Roles</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $admin )
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->user_name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                @foreach ($admin->roles as $role )
                                                    <span class="badge badge-success mr-2">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.admins.destroy', [$admin->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                        <a href="{{ route('admin.admins.edit', [$admin->id]) }}" class="btn btn-primary btn-xs text-white">Edit</a>
                                                    @endif
                                                    @if (Auth::guard('admin')->user()->can('admin.delete'))
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
